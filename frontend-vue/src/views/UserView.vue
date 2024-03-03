<template>
  <div class="d-grid col-6 mx-1 mb-3 mt-4">
    <router-link :to="{path:'/users'}" style="text-decoration: none; font-weight: bold;">
      <i class="fa-solid fa-arrow-left"></i>
      Go Back
    </router-link>
  </div>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header bg-dark text-white text-center">
          User Info
        </div>
        <div class="card-body">
          <div class="d-grid col-6 mx-auto mb-3">
            <img height="100" class="img-thumbnail" id="photoimg" src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <label v-text="this.name" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
            <label v-text="idCardNumber" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
            <label v-text="age" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-mars-and-venus"></i></span>
            <label v-text="genre" class="form-control"></label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
            <label v-text="email" class="form-control"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Bar Code</th>
              <th>Price</th>
              <th> </th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="content">
            <tr v-if="this.isLoading">
              <td colspan="6"><h3>Loading...</h3></td>
            </tr>
            <tr v-else v-for="product, index in this.products" :key="index">
              <td v-text="product.id"></td>
              <td v-text="product.name"></td>
              <td v-text="product.bar_code"></td>
              <td v-text="product.price"></td>
              <td>
                <router-link :to="{path: '/products/'+product.id}" class="btn btn-info">
                    <i class="fa-solid fa-eye"></i>
                </router-link>
                &nbsp;
                <router-link :to="{path: '/users/edit/'+user.id}" class="btn btn-warning">
                    <i class="fa-solid fa-edit"></i>
                </router-link>
                &nbsp;
                <button class="btn btn-danger" v-on:click="$event => deleteUser(user.id)">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import { mostrarAlerta, enviarSolicitud } from '../functions'
  import {useRoute} from 'vue-router'
  import axios from 'axios'

  export default{

    data() {
      return{
        id: 0,
        name:'',
        idCardNumber: '',
        age: null,
        genre: null,
        email: '',
        user: null,
        url: 'http://127.0.0.1:8000/api/users',

        products: null,
        url_products: 'http://127.0.0.1:8000/api/products',
        isLoading: false,
      }
    },

    mounted() {
      const route = useRoute()
      this.id = route.params.id
      this.url = `${this.url}/${this.id}`
      this.getUser()
      this.getProducts()
    },

    methods:{

      getUser(){
        axios.get(this.url).then(
          res => {
            this.name = res.data.name
            this.idCardNumber = res.data.id_card_number
            this.age = res.data.age
            this.genre  = res.data.genre
            this.email  = res.data.email
            this.user = res.data
          }
        ) 
      },

      getProducts(){
        let url_products_user = `${this.url_products}?user-id=${this.id}`
        axios.get(url_products_user).then(res => {
          this.products = res.data
          this.isLoading = false
        })
      },

      update(){
        if((this.name.trim() === '') ||
          (this.idCardNumber.trim() === '') ||
          (this.age < 18) ||
          (this.genre <= 0 || this.genre > 2) ||
          (this.email.trim() === '')
        ){
          mostrarAlerta('Type valid values into the fields', 'warning', 'name')
        } else{
          let jsonData = {
            name: this.name.trim(),
            id_card_number: this.idCardNumber.trim(),
            age: this.age,
            genre: this.genre,
            email: this.email.trim(),
          }
          enviarSolicitud('put', jsonData, this.url, 'User succesfully updated!!')
        }
      },

    }
  }
</script>
