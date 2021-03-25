<template>
       <div class="col-md-6">
            <h3 class="card-title">{{product.name}}</h3>
            <h4>
                <router-link
        :to="{ name: 'viewcategory', params: { id:category.id } }"
        class="btn btn-link"
      >
        {{ category.name }}
      </router-link>
            </h4>
           <div class="card" >
        <img class="card-img-top" :src="'http://localhost:8000/images/'+product.image" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">{{product.name}}</h5>
          <p class="card-text">
            {{product.short_description}}
          </p>
          <p class="card-text">
            {{product.description}}
          </p>
          <p class="card-text">
              {{product.price}} BDT
          </p>
          
        </div>
      </div>
       </div>
</template>

<script>
export default {
    data() {
        return {
            product: {},
            category:{}
        }
    },
    created() {
        
            this.$axios.get(`/api/product/${this.$route.params.slug}`)
                .then(response => {
                    this.product = response.data;
                    this.category = response.data.category;

                })
                .catch(function (error) {
                    console.error(error);
                });
        
    },

}
</script>
