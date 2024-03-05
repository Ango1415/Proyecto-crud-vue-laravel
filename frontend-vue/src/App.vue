<template>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <router-link 
      to="/"
      class="navbar-brand"
      > Avances
    </router-link>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link 
            to="/users" 
            class="nav-link active" 
            aria-current="page"
            > Usuarios
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <router-view/>
</div>
</template>

<script>
  import { RouterLink, RouterView } from 'vue-router'
  import axios from 'axios'

  export default{

    mounted(){
      this.getGenresFromDB()
    },

    data(){
      return{
        GENRES: []
      }
    },

    // QUEDE ACÁ: ALMACENA LOS OBJETOS EN LUGAR DEL SOLO DATO
    methods:{
      getGenresFromDB(){
        axios.get('http://127.0.0.1:8000/api/genres').then(
          res => res.data.forEach(genre => {
            //console.log(genre.genre_name)
            this.GENRES.push(genre.genre_name)
            console.log(this.GENRES)
          })
        )
      },

      getGenres(){
        return this.GENRES
      }
    }
  }
</script>