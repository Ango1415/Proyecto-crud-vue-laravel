<template>
  <div class="about">
    <br>
    <h3>Users:</h3>
    <router-link :to="{path:'/users/create'}" class="btn btn-success">
      <i class="fa-solid fa-floppy-disk"></i>
      Create User
    </router-link>
  </div>
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>ID Card Number</th>
              <th>Age</th>
              <th>Genre</th>
              <th>Email</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="content">
            <tr v-if="this.isLoading">
              <td colspan="6"><h3>Loading...</h3></td>
            </tr>
            <tr v-else v-for="user, index in this.users" :key="index">
                <td v-text="user.id"></td>
                <td v-text="user.name"></td>
                <td v-text="user.id_card_number"></td>
                <td v-text="user.age"></td>
                <td v-text="genres[user.genre-1]"></td>
                <td v-text="user.email"></td>
              <td>
                <router-link :to="{path: '/users/'+user.id}" class="btn btn-info">
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
  import axios from 'axios' //Esto nos ayudará a realiza las peticiones HTTP
  import {confirmarAlerta} from '../functions'
  import GENRES from '../App.vue'

  export default{
    data(){
      return {
        users: null,
        genres: GENRES,
        isLoading: false,
      }
    },

    mounted(){
      this.preload();
    },

    methods:{
      getUsers(){
        this.isLoading = true
        axios.get('http://127.0.0.1:8000/api/users').then(
          res => {
            this.users = res.data
            this.isLoading = false
          }
        )
      },

      getGenres(){
        axios.get('http://127.0.0.1:8000/api/genres').then(
          res => this.genres = res.data
        )
      },

      preload(){
        this.getUsers()
        this.getGenres()
        this.isLoading = false
      },

      deleteUser(userId){
        confirmarAlerta('http://127.0.0.1:8000/api/users/', userId, 'Eliminar Registro', '¿Realmente desea eliminar este registro?')
        this.isLoading=false
      }
    }
  }
</script>
  