<template>
    
  <div>

     <!-- herosec SEC -->
     <div class="heroSec">
        <div class="hero">
              <h2 class="welcome_title">Non sai dove andare? <br> Nessun problema!</h2>
              <a href="#" class="btn_visit d-flex align-items-center">
                  <span class="gradient">
                  parti adesso     
                   <i class="fa-solid fa-rocket"></i>             
                  </span>

                  
                
              </a>
               
        </div>

     </div>


    
    <div class="sponsored_apartments_container container">
      <h1 class="py-5 page_title">Sponsored Apartments</h1>
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
              

              <div class="card_bottom">

                <!-- <h6 class="card-subtitle mb-2 text-muted">Sponsored</h6> -->
                <div class="sponsored">
                 
                
                  <i class="fa-solid fa-crown"></i>
                </div>

                <div class="card_info">
                   <h5 class=" card_title">{{ sponsored_apartment.title }}</h5>

                

                    <div class="info_type_wrapper">
                        <i class="fa-solid fa-location-dot"></i>
                        <p class="card_text">

                           {{ sponsored_apartment.address }}
                        </p>
                    </div>

                  

                    <div class="info_type_wrapper">
                      
                        <p class="card_text">
                           

                           {{ sponsored_apartment.squared_meters }}
                        </p>
                        

                        m<sup>2</sup>

                    </div>

                    <div class="info_type_wrapper">
                        <p class="card_text">
                          

                           {{ sponsored_apartment.price }}
                        </p>
                         <i class="fa-solid fa-dollar-sign"></i>
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