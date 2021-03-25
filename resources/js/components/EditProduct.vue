<template>
  <div>
    <h4 class="text-center">Edit Product</h4>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="updateProduct" enctype="multipart/form-data">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="product.name" />
          </div>
          <div class="form-group">
            <label>Category</label>
            <select v-model="category_id" class="form-control">
              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label>Image</label>
            <input
              @change="selectFile"
              type="file"
              class="form-control"
              name="image"
            />
          </div>
          <div class="form-group">
            <label>Short Description</label>
            <textarea
              type="text"
              class="form-control"
              v-model="product.short_description"
            ></textarea>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea
              type="text"
              class="form-control"
              v-model="product.description"
            ></textarea>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="number" class="form-control" v-model="product.price" />
          </div>

          <h4 class="text text-danger">{{ this.errorMessage }}</h4>
          <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
            image:null,
            categories: [],
            product: {},
            category_id:"",
            errorMessage:"",
    };
  },
  created() {
    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
      this.$axios
        .get(`/api/products/${this.$route.params.id}`)
        .then((response) => {
          this.product = response.data;
            this.$axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                    this.category_id=this.product.category_id
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
        .catch(function (error) {
          console.error(error);
        });
    });
  },
  methods: {
      selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            this.image = event.target.files[0];
        },
    updateProduct() {
         if(!this.product.name||!this.category_id||!this.product.short_description||!this.product.description||!this.product.price){
                    this.errorMessage="Please fill all the field";
                    return;
                }
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
           const data = new FormData();
                data.append('image', this.image);
                data.append('name', this.product.name);
                data.append('category_id', this.category_id);
                data.append('short_description', this.product.short_description);
                data.append('description', this.product.description);
                data.append('price', this.product.price);
        this.$axios
          .post(`/api/products/${this.$route.params.id}`, data)
          .then((response) => {
            this.$router.push({ name: "product" });
          })
          .catch(function (error) {
            console.error(error);
          });
      });
    },
  },
  beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/";
    }
    next();
  },
};
</script>
