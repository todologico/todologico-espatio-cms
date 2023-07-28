// GLOBAL API

const { createApp } = Vue

import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

createApp({
          
  data() 
  {
    console.log(`the component is now mounted.`)
      return { 

        someObject: {},
        status: false,
        backarray: false,
        obj: {
          nested: { count: 0 },
          arr: ['foo', 'bar']
        }    
      }
  },
  methods: {

    mutateDeeply() {
      // these will work as expected.
      this.obj.nested.count++
      this.obj.arr.push('baz')
    }
    

    //--------------------------------
    async ShowHideBannersAR(aab_bann1_id,aab_bann1_token,button)     
    {

      this.aab_bann1_id = aab_bann1_id;
      this.aab_bann1_token = aab_bann1_token;
      this.button = button;
    
      if(this.aab_bann1_id) { 
        if(this.aab_bann1_token) { 

            axios.post('/aab-bann1-publish-pro', {

                aab_bann1_id: this.aab_bann1_id,
                aab_bann1_token: this.aab_bann1_token,
                button: this.button

            }, {headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}})

          .then(function (response) {

            if(response.data='200'){             

                  switch (button) {    
                  
                    case '1': //publicado1 to suspendido 2

                    console.log(response.data);
                    console.log(response.status);
                    console.log('elid'+response.data.aab_bann1_id);
                    console.log('eltoken'+response.data.aab_bann1_token);
                    console.log('elbutton'+button); 
                    
                    "butt2on".response.data.aab_bann1_id = false;
                    "butt1on".response.data.aab_bann1_id = true;

                    break;

                    case '2': //publicado1 to suspendido 2

                    console.log(response.data);
                    console.log(response.status);
                    console.log('elid'+response.data.aab_bann1_id);
                    console.log('eltoken'+response.data.aab_bann1_token);
                    console.log('elbutton'+button); 

                    "butt2on".response.data.aab_bann1_id = true;
                    "butt1on".response.data.aab_bann1_id = false;

      
                    break;
                  }

          }
            
                 

          })

          .catch(function (error) {
            console.log(error);
          });   

         

        }
      }
      
      
    }



  }



}).mount('#app')