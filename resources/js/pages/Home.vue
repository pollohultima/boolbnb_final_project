<template>
  <div>
    <!-- herosec SEC -->
    <div class="heroSec">
      <div class="hero">
        <h2 class="welcome_title">
          Parti adesso!
          <br />
          Cosa stai aspettando?
        </h2>

        <div class="search_sec">
          <form action="" class="search_form">
            <div class="search_input_wrapper">
              <label for="address">Indirizzo / Città *</label>
              <div id="searchbox" style="border-radius: 50px"></div>
            </div>

            <!-- <div class="search_input_wrapper">
                            <label for="rooms">stanze</label>
                            <input type="number" id="rooms" name="rooms" />
                        </div> -->
            <!-- 
                        <div class="search_input_wrapper">
                            <label for="services">scegli un servizio:</label>
                            <select name="services" id="services">
                                <option value="1">WiFi</option>
                                <option value="2">Posto Macchina</option>
                                <option value="3">piscina</option>
                                <option value="4">Portineria</option>
                                <option value="5">Sauna</option>
                                <option value="6">Vista Mare</option>
                            </select>
                        </div>
 -->
            <button @click="shareAddress" class="submit_search">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="sponsored_apartments_container container">
      <h1 class="pb-5 page_title">Appartamenti sponsorizzati</h1>
      <div class="row justify-content-center g-5">
        <div
          class="col-8 col-md-6 col-lg-4 sponsored_apartment_card"
          v-for="sponsored_apartment in sponsored_apartments_list"
          :key="sponsored_apartment.slug"
        >
          <!-- inizio card -->
          <div class="card">
            <div class="card_body">
              <div class="card_img_wrapper">
                <img
                  :src="'/storage/' + sponsored_apartment.image"
                  class="card-img-top"
                  alt="..."
                />
              </div>

              <div class="card_bottom">
                <!-- Bollino solo sponsorizzati -->
                <div class="sponsored">
                  <div class="img_wrapper_sponsor">
                    <img
                      src="../../img/BOOLBNB_white.svg"
                      class="logo_image"
                      alt=""
                    />
                  </div>
                </div>
                <!-- /Bollino solo sponsorizzati -->

                <div class="card_info">
                  <h5 class="card_title">
                    {{ sponsored_apartment.title }}
                  </h5>

                  <div class="info_type_wrapper info_type_wrapper_address">
                    <!-- <i class="fa-solid fa-location-dot"></i> -->
                    <p class="card_text">
                      {{ sponsored_apartment.address }}
                    </p>
                  </div>

                  <div class="metres_cost">
                    <div class="info_type_wrapper">
                      <p class="card_text">
                        {{ sponsored_apartment.squared_meters }}
                      </p>

                      m<sup>2</sup>
                    </div>

                    <div class="info_type_wrapper">
                      <p class="card_text_cost">
                        {{ sponsored_apartment.price }}
                      </p>
                      <p class="dollar">$</p>
                    </div>
                  </div>

                  <div class="button_wrapper">
                    <router-link
                      :to="'/apartments/' + sponsored_apartment.slug"
                      class="button_view"
                    >
                      visita
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /fine card -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      sponsored_apartments_list: null,
      tomtom_result: "1",
      encoded_address: "",
      autocompleted_address: "",
    };
  },
  mounted() {
    axios.get("../api/apartments").then((r) => {
      this.sponsored_apartments_list = r.data.data;
    });
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
    document.getElementById("searchbox").append(searchBoxHTML);
    ttSearchBox.on("tomtom.searchbox.resultsfound", function (data) {
      if (data.data.results.fuzzySearch.results == "") {
        self.autocompleted_address = "";
      } else {
        self.autocompleted_address =
          data.data.results.fuzzySearch.results[0].address.freeformAddress;
      }
    });
  },
  methods: {
    shareAddress() {
      if (this.autocompleted_address != "") {
        this.$router.push({
          name: "apartments",
          params: { data: this.autocompleted_address, flag: "true" },
        });
      }
    },
  },
};
</script>

<style></style>
