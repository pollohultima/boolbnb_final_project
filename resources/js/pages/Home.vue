<template>
    
  <div>

     <!-- herosec SEC -->
     <div class="heroSec">
        <div class="hero">
              <h2 class="welcome_title">Non sai dove andare? <br> Nessun problema!</h2>
              <a href="#" class="btn_visit">
                  <span class="gradient">
                  parti adesso 
                  
                 
                  </span>
                  
                 <i class="fa-solid fa-rocket"></i>
              </a>
        </div>

     </div>


    <h1 class="text-center py-5">Sponsored Apartments</h1>
    <div class="sponsored_apartments_container container">
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
                :src="sponsored_apartment.image"
                class="card-img-top"
                alt="..."
              />
              </div>
              

              <div class="card_info">
                <h5 class="card-title">{{ sponsored_apartment.title }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Sponsored</h6>
                <p class="card-text">
                  {{ sponsored_apartment.title }}
                </p>

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
      sponsored_apartments_list: null,
    };
  },
  mounted() {
    axios.get("../api/apartments").then((r) => {
      this.sponsored_apartments_list = r.data;
    });
  },
};
</script>

<style>
</style>