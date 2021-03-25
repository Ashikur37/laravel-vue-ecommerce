<template>
  <div>
    <h4>Categories</h4>
  </div>
  <div class="row">
    <div v-for="category in categories" :key="category.id" class="col-md-3">
      <router-link
        :to="{ name: 'viewcategory', params: { id: category.id } }"
        class="btn btn-link"
      >
        {{ category.name }}
      </router-link>
    </div>
  </div>
  <div class="row">
    <div v-for="product in products" :key="product.id" class="col-md-3">
      <div class="card" style="width: 18rem">
        <img class="card-img-top" :src="'images/'+product.image" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">{{product.name}}</h5>
          <p class="card-text">
            {{product.short_description}}
          </p>
          <p class="card-text">
              {{product.price}} BDT
          </p>
          <router-link
        :to="{ name: 'viewproduct', params: { slug: product.slug } }"
        class="btn btn-primary"
      >
      View
      </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      categories: [],
      products: [],
    };
  },
  created() {
    this.$axios
      .get("/api/category-list")
      .then((response) => {
        this.categories = response.data;
        this.$axios
          .get("/api/product-list")
          .then((response) => {
            this.products = response.data;
          })
          .catch(function (error) {
            console.error(error);
          });
      })
      .catch(function (error) {
        console.error(error);
      });
  },
  methods: {},
};
</script>
