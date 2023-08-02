// GLOBAL API

const { createApp } = Vue

import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

createApp({
          
  data() 
  {
    console.log(`the component is now mounted ahora.`)
      return {     
        status: false
      }
  },
  methods: {

    //--------------------------------
    async ShowHideBannersAR(aab_bann1_id,aab_bann1_token,button)     
    {

      console.log('butt1on'+aab_bann1_id);

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

            if(response.status='200'){             

                  switch (button) {    
                  
                    case '1': //de prendido hacia apagado

                    console.log('de prendido hacia apagado');
                    console.log('data es:'+JSON.stringify(response.data));
                    console.log(response.statusText);
                    console.log('el_id es:'+response.data.aab_bann1_id);
                    console.log('el_button es: '+button); 
                    
                    //$scope['butt1on'+$scope.backarray.bbp_prod1_id] = true; //ng-hide


                    Object.assign('butt2on'+response.data.aab_bann1_id, true)
                    Object.assign('butt1on'+response.data.aab_bann1_id, false)

                    console.log('butt2on'+response.data.aab_bann1_id);

                  //  this.id['butt2on'+response.data.aab_bann1_id] = true;
                  //  this.id['butt1on'+response.data.aab_bann1_id] = false;

                    //hidde the on button
                    //this['butt1on'+response.data.aab_bann1_id] = false;

                    //show the off button
                    //this['butt2on'+response.data.aab_bann1_id] = true;

                   // this.['butt2on'+response.data.aab_bann1_id] = false;
                    //this.['butt1on'+response.data.aab_bann1_id] = true;
                    
                   // "'butt2on'.response.data.aab_bann1_id" = false;
                   // "'butt1on'.response.data.aab_bann1_id" = true;
                   //$scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#FFEAE7" };

                    break;

                    case '2': //de apagado a prendido

                    console.log('de apagado a prendido');

                    /*

                    console.log(response.data);
                    console.log(response.status);
                    console.log('el_id ggg'+response.data.aab_bann1_id);
                    console.log('el_token'+response.data.aab_bann1_token);
                    console.log('el_button'+button); 

                    "butt2on".response.data.aab_bann1_id = true;
                    "butt1on".response.data.aab_bann1_id = false;
                    //$scope['bcolor'+$scope.backarray.aab_bann1_id] = { "background-color": "#EBF9E4" };

                    */

      
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