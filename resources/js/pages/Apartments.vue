<template>
  <div>
    <div class="search_apartment mt-5 apartments_page">
      <div class="search_form">
        <div class="form_search_top">
          <div class="search_input_wrapper">
            <label for="address">Indirizzo / città</label>
            <div id="searchbox" style="border-radius: 50px"></div>
            <input id="temp_address" v-model="address" style="display: none" />
          </div>
          <div class="search_input_wrapper">
            <label for="km_radius">Raggio(km)</label>
            <input
              v-model.number="km_radius"
              @keypress="onlyNumber"
              type="number"
              id="km_radius"
              name="km_radius"
            />
          </div>
        </div>

        <div class="form_search_bottom">
          <div class="search_input_wrapper">
            <label for="beds">Letti</label>
            <input
              v-model.number="beds"
              @keypress="onlyNumber"
              type="number"
              id="beds"
              name="beds"
            />
          </div>

          <div class="search_input_wrapper">
            <label for="beds">Stanze</label>
            <input
              v-model.number="rooms"
              type="number"
              @keypress="onlyNumber"
              id="rooms"
              name="rooms"
            />
          </div>

          <div class="search_input_wrapper">
            <label for="services">Scegli un servizio:</label>
            <!-- trovare soluzione alternativa al "multiple" -->
            <select
              name="services"
              v-model="services"
              id="services"
              class="select_services"
              multiple
            >
              <option value="1">WiFi</option>
              <option value="2">Posto Macchina</option>
              <option value="3">piscina</option>
              <option value="4">Portineria</option>
              <option value="5">Sauna</option>
              <option value="6">Vista Mare</option>
            </select>
          </div>

          <button @click="get_apartments" class="submit_search align_start">
           <a href="#apartment_sec_scroll"> <i class="fa-solid fa-magnifying-glass"></i></a>
          </button>
        </div>

        <!-- <div class="search_input_wrapper">
          <label for="services">scegli un servizio:</label>
          <select name="services" id="services">
            <option value="1">WiFi</option>
            <option value="2">Posto Macchina</option>
            <option value="3">piscina</option>
            <option value="4">Portineria</option>
            <option value="5">Sauna</option>
            <option value="6">Vista Mare</option>
          </select>
        </div> -->
      </div>
    </div>

    <div class="sponsored_apartments_container container">
      <h1 class="page_title py-5" id="apartment_sec_scroll">Scopri la soluzione più adatta a te</h1>
      <div class="row justify-content-center g-5">

        <h3 v-if="!apartments.length">&#128549; non ci sono appartamenti</h3>
        <div
          class="col-8 col-md-6 col-lg-4 sponsored_apartment_card"
          v-for="apartment in apartments"
          :key="apartment.slug"
        >
          <div class="card">
            <div class="card_body">
              <div class="card_img_wrapper">
                <img
                  :src="'/storage/' + apartment.image"
                  class="card-img-top"
                  alt="..."
                />
              </div>

              <div class="card_bottom">
                <!-- <h6 class="card-subtitle mb-2 text-muted">Sponsored</h6> -->
                <div class="sponsored">
                  <div class="img_wrapper_sponsor">
                    <img
                      src="../../img/BOOLBNB_white.svg"
                      class="logo_image"
                      alt=""
                    />
                  </div>
                </div>

                <div class="card_info">
                  <h5 class="card_title">
                    {{ apartment.title }}
                  </h5>

                  <div class="info_type_wrapper info_type_wrapper_address">
                    <!-- <i class="fa-solid fa-location-dot"></i> -->

                    <p class="card_text">
                      {{ apartment.address }}
                    </p>
                  </div>

                  <div class="metres_cost">
                    <div class="info_type_wrapper">
                      <p class="card_text">
                        {{ apartment.squared_meters }}
                      </p>

                      m<sup>2</sup>
                    </div>

                    <div class="info_type_wrapper">
                      <p class="card_text_cost">
                        {{ apartment.price }}
                      </p>
                      <p class="dollar">$</p>
                    </div>
                  </div>
                  <div class="button_wrapper">
                    <router-link
                      :to="'/apartments/' + apartment.slug"
                      class="button_view"
                    >
                      visita
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      apartments: [],
      address: "",
      beds: "",
      services: [],
      rooms: "",
      km_radius: "",
      encoded_address: "",
      url_rooms: "&rooms=0",
      url_beds: "&beds=0",
      url_km_radius: "&km_radius=20",
      autocompleted_address: "",
      passed_from_homepage: "false",
      services_for_api: "",
    };
  },
  mounted() {
    var options = {
      searchOptions: {
        key: "L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs",
        language: "it-IT",
        limit: 5,
        countrySet: "IT",
      },
      autocompleteOptions: {
        key: "L5vJ5vBEzTCuKlxTimT8J5hFnGD9TRXs",
        language: "it-IT",
        resultSet: "Str"
      },
      labels: {
        placeholder: "Inserisci il tuo indirizzo",
        noResultsMessage: "Nessun riferimento trovato.",
      },
    };
    var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
    var self = this;
    var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
    searchBoxHTML.getElementsByClassName("tt-search-box-input")[0].id =
      "address";
    searchBoxHTML.getElementsByClassName("tt-search-box-input")[0].name =
      "address";
    searchBoxHTML.getElementsByClassName("tt-search-box-input")[0];
    var temp_address = document.getElementById("temp_address").value;
    searchBoxHTML
      .getElementsByClassName("tt-search-box-input")[0]
      .setAttribute("value", temp_address);
    document.getElementById("searchbox").append(searchBoxHTML);
    ttSearchBox.on("tomtom.searchbox.resultsfound", function (data) {
      if (data.data.results.fuzzySearch.results == "") {
        self.address = "";
      } else {
        self.address =
          data.data.results.fuzzySearch.results[0].address.freeformAddress;
      }
    });
  },
  methods: {
    onlyNumber($event) {
      //console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if (keyCode < 48 || keyCode > 57) {
        // 46 is dot
        $event.preventDefault();
      }
    },
    get_apartments() {
      if (this.address != "") {
        if (this.rooms > 0) {
          this.url_rooms = "&rooms=" + this.rooms;
        }
        if (this.beds > 0) {
          this.url_beds = "&beds=" + this.beds;
        }
        if (this.km_radius > 0) {
          this.url_km_radius = "&km_radius=" + this.km_radius;
        }
        if (this.services.length) {
          this.services_for_api = "&services=";
          console.log(this.services);
        }
        this.encoded_address = encodeURIComponent(this.address);
        axios
          .get(
            "../api/advanced_search?" +
              this.url_rooms +
              this.url_beds +
              this.url_km_radius +
              "&address=" +
              this.encoded_address +
              this.services_for_api +
              this.services
          )
          .then((r) => {
            this.apartments = r.data;
            console.log(r);
          });
      }
    },
  },
  created() {
    this.address = this.$route.params.data;
    if (this.$route.params.flag == null) {
      this.passed_from_homepage = "";
    } else {
      this.passed_from_homepage = this.$route.params.flag;

      this.encoded_address = encodeURIComponent(this.address);
      axios
        .get(
          "../api/advanced_search?" +
            this.url_rooms +
            this.url_beds +
            this.url_km_radius +
            "&address=" +
            this.encoded_address
        )
        .then((r) => {
          this.apartments = r.data;
          console.log(r);
        });
    }
  },
};
</script>

<style></style>
