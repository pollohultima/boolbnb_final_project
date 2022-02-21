<template>
    <div>
        <!-- herosec SEC -->
        <div class="heroSec">
            <div class="hero">
                <h2 class="welcome_title">
                    Non sai dove andare? <br />
                    Nessun problema!
                </h2>
                <a href="#" class="btn_visit d-flex align-items-center">
                    <span class="gradient">
                        parti adesso
                        <i class="fa-solid fa-rocket"></i>
                    </span>
                </a>
                <div class="search_sec">
                    <form action="" class="search_form">
                        <div class="search_input_wrapper">
                            <label for="beds">letti</label>
                            <input type="number" id="beds" name="beds" />
                        </div>

                        <div class="search_input_wrapper">
                            <label for="rooms">stanze</label>
                            <input type="number" id="rooms" name="rooms" />
                        </div>

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

                        <button
                            type="submit"
                            value="Submit"
                            class="submit_search"
                        >
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
                    class="col-4 sponsored_apartment_card"
                    v-for="sponsored_apartment in sponsored_apartments_list"
                    :key="sponsored_apartment.slug"
                >
                    <div class="card">
                        <div class="card_body">
                            <div class="card_img_wrapper">
                                <img
                                    :src="
                                        '/storage/' + sponsored_apartment.image
                                    "
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
                                        {{ sponsored_apartment.title }}
                                    </h5>

                                    <div
                                        class="info_type_wrapper info_type_wrapper_address"
                                    >
                                        <!-- <i class="fa-solid fa-location-dot"></i> -->

                                        <p class="card_text">
                                            {{ sponsored_apartment.address }}
                                        </p>
                                    </div>

                                    <div class="metres_cost">
                                        <div class="info_type_wrapper">
                                            <p class="card_text">
                                                {{
                                                    sponsored_apartment.squared_meters
                                                }}
                                            </p>

                                            m<sup>2</sup>
                                        </div>

                                        <div class="info_type_wrapper">
                                            <p class="card_text_cost">
                                                {{ sponsored_apartment.price }}
                                            </p>
                                            <p class="dollar">$</p>
                                        </div>
                                        <div class="button_wrapper">
                                            <router-link
                                                :to="
                                                    '/apartments/' +
                                                    sponsored_apartment.slug
                                                "
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
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            sponsored_apartments_list: null,
        };
    },
    mounted() {
        axios.get("../api/apartments").then((r) => {
            this.sponsored_apartments_list = r.data.data;
        });
    },
};
</script>

<style></style>
