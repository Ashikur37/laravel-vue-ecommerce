<template>
    <div>
        <h4 class="text-center">{{category.name}}</h4>
          <div class="row">
    <div v-for="product in category.products" :key="product.id" class="col-md-3">
      <div class="card" style="width: 18rem">
        <img class="card-img-top" :src="'http://localhost:8000/images/'+product.image" alt="Card image cap" />
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            category: {}
        }
    },
    created() {
        
            this.$axios.get(`/api/category/${this.$route.params.id}`)
                .then(response => {
                    this.category = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        
    },

}
</script>
