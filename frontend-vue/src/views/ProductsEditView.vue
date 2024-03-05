<template>
    <div class="d-grid col-6 mx-1 mb-3 mt-4">
        <router-link :to="{path:`/users/${user_id}`}" style="text-decoration: none; font-weight: bold;">
            <i class="fa-solid fa-arrow-left"></i>
            Go Back
        </router-link>
    </div> 
    <div class="row mt-3">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    Product Edit
                </div>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="update">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i></span>
                        <input type="text" v-model="name" class="form-control" id="name" placeholder="Type a name" required maxlength="50">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" v-model="bar_code" class="form-control" id="bar_code" placeholder="Type a bar code" required maxlength="50">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                        <input type="number" v-model="price" class="form-control" id="price" placeholder="Type a price" required maxlength="7">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="number" v-model="user_id" class="form-control" id="user_id" placeholder="Type a user id" required maxlength="2">
                    </div>
                    <div class="d-grid col-6 mx-auto mb-3">
                        <button class="btn btn-warning">
                            <i class="fa-solid fa-edit"></i>
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { mostrarAlerta, enviarSolicitud } from '../functions'
    import axios from 'axios'
    import {useRoute} from 'vue-router'


    export default{

        data(){
            return {
                id: 0,
                name: '',
                bar_code: '',
                price: null,
                user_id: null,
                url: 'http://127.0.0.1:8000/api/products',
                isLoading: false,
            }
        },
    
        mounted(){
            const route = useRoute()
            this.id = route.params.id
            this.url = `${this.url}/${this.id}`
            this.getProduct()
        },
    
        methods:{
            getProduct(){
                axios.get(this.url).then(
                    res=>{
                        this.name = res.data.name
                        this.bar_code = res.data.bar_code
                        this.price = res.data.price
                        this.user_id = res.data.user
                })
            },

            update(){
                if((this.name.trim() === '') || 
                    (this.bar_code.trim() === '') || 
                    (this.price < 0) || 
                    (this.user_id<0)){
                        mostrarAlerta('Type valid values into the fields', 'warning', 'name')
                } else{
                    let jsonData = {
                        name: this.name.trim(),
                        bar_code: this.bar_code.trim(),
                        price: this.price,
                        user: this.user_id
                    }
                    enviarSolicitud('put', jsonData, this.url, 'User succesfully updated!!')
                }
            },
        }
    }
</script>