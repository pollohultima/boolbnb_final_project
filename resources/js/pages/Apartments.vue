<template>
  <div>
    <div class="search_apartment mt-5">
      <div class="search_form">
        <div class="search_input_wrapper">
          <label for="beds">Letti</label>
          <input v-model="beds" type="number" id="beds" name="beds" />
        </div>

        <div class="search_input_wrapper">
          <label for="address">Indirizzo</label>
          <input v-model="address" type="text" id="address" name="address" />
        </div>

        <div class="search_input_wrapper">
          <label for="beds">Stanze</label>
          <input v-model="rooms" type="number" id="rooms" name="rooms" />
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

        <div class="search_input_wrapper">
          <label for="km_radius">Tolleranza(km)</label>
          <input
            v-model="km_radius"
            type="number"
            id="km_radius"
            name="km_radius"
          />
        </div>

        <button @click="get_apartments" class="submit_search">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </div>

    <div class="sponsored_apartments_container container">
      <h1 class="page_title py-5">Apartments List</h1>
      <div class="row justify-content-center g-5">
        <div
          class="col-4 sponsored_apartment_card"
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
      rooms: "",
      km_radius: "",
      encoded_address: "",
    };
  },
  methods: {
    get_apartments() {
      this.encoded_address = encodeURIComponent(this.address);
      axios
        .get(
          "../api/advanced_search?rooms=" +
            this.rooms +
            "&km_radius=" +
            this.km_radius +
            "&address=" +
            this.encoded_address
        )
        .then((r) => {
          this.apartments = r.data;
          console.log(r);
        });
    },
  },
};
</script>

<style></style>
