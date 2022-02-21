<template>
  <div
    class="sponsored_apartments_container container"
    style="margin-top: 100px"
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
          <!--  <div class="sponsored">
                    <div class="img_wrapper_sponsor">
                        <img
                            src="../../img/BOOLBNB_white.svg"
                            class="logo_image"
                            alt=""
                        />
                    </div>
                </div> -->

          <div class="card_info">
            <h5 class="card_title">{{ apartment.title }}</h5>

            <div class="metres_cost">
              <div class="info_type_wrapper">
                <p class="card_text">
                  Superficie: {{ apartment.squared_meters }}
                </p>

                m<sup>2</sup>
              </div>

              <div class="info_type_wrapper">
                <p class="card_text_cost">Prezzo: {{ apartment.price }}</p>
                <p class="dollar">$</p>
              </div>
            </div>
            <div class="info_type_wrapper info_type_wrapper_address">
              <!-- <i class="fa-solid fa-location-dot"></i> -->

              <p class="card_text">Indirizzo: {{ apartment.address }}</p>
              <div id="map" class="map col-5"></div>
            </div>
          </div>
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
      apartment: [],
    };
  },

  mounted() {
    axios.get("/api/apartments/" + this.$route.params.slug).then((r) => {
      this.apartment = r.data;
    });
  },
};
</script>

