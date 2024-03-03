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
                    Product Info
                </div>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i></span>
                <label v-text="name" class="form-control"></label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                <label v-text="bar_code" class="form-control"></label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                <label v-text="price" class="form-control"></label>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <label v-text="user_id" class="form-control"></label>
            </div>
        </div>
    </div>
</template>

<script>
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
            }
        }
    }


</script>