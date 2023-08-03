// GLOBAL API

const { createApp } = Vue

import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

createApp({

 
          
  data() 
  {
    console.log(`the component is mounted now.`)
      return {     
        status: false,
      }
  },
  methods: {

    //--------------------------------
    async ShowHideBannersAR(aab_bann1_id,aab_bann1_token,button)     
    {

      if(this.aab_bann1_id) { 
        if(this.aab_bann1_token) { 

          console.log('pepe');

            axios.post('/aab-bann1-publish-pro', {

                aab_bann1_id: this.aab_bann1_id,
                aab_bann1_token: this.aab_bann1_token,
                button: this.button

            }, {headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'}})

          .then(function (response) {

            if(response.status='200'){             

                  switch (button) {    
                  
                    case '1': //de prendido hacia apagado

                      console.log('de prendido hacia apagado');
                      console.log('data es:'+JSON.stringify(response.data));
                      console.log(response.statusText);
                      console.log('el_id es:'+response.data.aab_bann1_id);
                      console.log('el_button es: '+button); 
                   
             
                    
                   //$scope['butt1on'+$scope.backarray.bbp_prod1_id] = true; //ng-hide   
                   //$scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#FFEAE7" };

                    break;

                    case '2': //de apagado a prendido

                    console.log('de apagado a prendido');
      
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