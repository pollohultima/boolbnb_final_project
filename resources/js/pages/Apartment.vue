<template>
    <div class="show_sec_apartment">
        <div class="card">
            <!-- image -->
            <div class="top">
                <div class="image">
                    <img
                        :src="'/storage/' + apartment.image"
                        class="card-img-top"
                        alt="..."
                    />
                </div>
            </div>

            <!-- infos -->
            <div class="mid py-3">
                <div class="container">
                    <div class="row">
                        <!-- map -->
                        <div id="map" class="map col-5"></div>

                        <!-- details -->
                        <div class="infos col-7 px-4">
                            <!-- titolo -->
                            <h2 class="pt-3">{{ apartment.title }}</h2>
                            <h3 class="pb-4 col-9 info_address">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ apartment.address }}
                            </h3>

                            <div class="details container">
                                <div class="row">
                                    <div class="col">
                                        <div class="item">
                                            <h3>Stanze:</h3>
                                            <h3 class="value">
                                                {{ apartment.rooms }}
                                            </h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Bagni:</h3>
                                            <h3 class="py-1 value">
                                                {{ apartment.bathrooms }}
                                            </h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Letti:</h3>
                                            <h3 class="py-1 value">
                                                {{ apartment.beds }}
                                            </h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">Piano:</h3>
                                            <h3 class="py-1 value">
                                                {{ apartment.floor }}
                                            </h3>
                                        </div>
                                        <div class="item">
                                            <h3 class="py-1">
                                                Metri quadrati:
                                            </h3>
                                            <h3 class="py-1 value">
                                                {{ apartment.squared_meters }}
                                            </h3>
                                        </div>

                                        <div class="item item_price">
                                            <h3 class="py-1">Prezzo:</h3>
                                            <h3 class="py-1 value">
                                                {{ apartment.price }}€
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="bottom py-3">
                    <div class="services">
                        <h2>Servizi</h2>

                        <ul class="row">
                            <li v-for="service in services" :key="service.slug" class="col-4">
                                <i class="fa-solid fa-circle-check"></i> {{service.name}}
                            </li>
                        </ul>
                    </div>
                    <hr />
                    <div class="description">
                        <h2>Descrizione</h2>

                        <p class="py-1">{{ apartment.description }}</p>
                    </div>
                    <hr />
                    <form-component></form-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

import FormComponent from '../components/FormComponent.vue';

export default {
  components: { FormComponent },
    data() {
        return {
            apartment: [],
            services: []
        };
    },

    methods: {
        async getApt() {
            await axios
                .get("../api/apartments/" + this.$route.params.slug)
                .then((r) => {
                    this.apartment = r.data;
                });
        },

    /*     getServices(){
          axios
          .get("../api/services/").then((resp) => {
            this.services = resp.data;

          });
        } */
    },

    async mounted() {
        /* this.getServices(); */
        await this.getApt();

        var HomeCoordinates = [this.apartment.longitude, this.apartment.latitude];

        var map = tt.map({
            key: "3a6pOX546txENpMTLIdG3as2UoLVCypG",
            container: "map",
            center: HomeCoordinates,
            zoom: 15,
        });

        var marker = new tt.Marker().setLngLat(HomeCoordinates).addTo(map);
    },
};
</script>
