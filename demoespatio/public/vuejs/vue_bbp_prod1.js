// GLOBAL API

const { createApp } = Vue

import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

createApp({
          
  data() {

    console.log(`the component is now mounted.`)

    return { 
      
      count: 0,
      loading: false 
    
    }
  },

  methods: {
    async getPosts() {

      this.loading = 'http with axios ok'

      this.count++;

      console.log(this.loading);

      this.posts = await axios.get('https://jsonplaceholder.typicode.com/posts')
     
      console.log(this.posts);

    }
  }



}).mount('#app')