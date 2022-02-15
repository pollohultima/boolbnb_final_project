<template>
  <div>
    <h1 class="text-center py-5">Sponsored Apartments</h1>
    <div class="sponsored_apartments_container container">
      <div class="row justify-content-center">
        <div
          class="col-3 sponsored_apartment_card"
          v-for="sponsored_apartment in sponsored_apartments_list"
          :key="sponsored_apartment.slug"
        >
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <img
                :src="sponsored_apartment.image"
                class="card-img-top"
                alt="..."
              />
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