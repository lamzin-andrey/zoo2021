<template>
<div>
    <p class="text-right">
        <v-btn
                :disabled="requestSended"
                @click="onClickAddCage"
                elevation="2"
        >{{ $t('app.Add_cage') }}</v-btn>
    </p>
    
    <v-card v-for="cage in cages" :key="cage.id"
            elevation="2"
            class="mb-3"
    >
        <v-card-title>{{ $t('app.Cage') + ' ' + (cage.name ? cage.name : ('#' + cage.id) ) }}</v-card-title>
        <v-img
          
          :src="cage.image"
        ></v-img>
        <v-card-actions>
            <v-btn
            color="deep-purple lighten-2"
            text
            @click="onClickAddAnimal(cage.id, cage.type)"
            >{{ $t('app.addAnimal') }}</v-btn>
        </v-card-actions>
    </v-card>

    <v-app id="inspire">
        <div class="text-center">
          <v-dialog
            v-model="dialog"
            width="500"
          >
      
            <v-card>
              <v-card-title class="headline grey lighten-2">
                {{ $t('app.Select_animal_type') }}
              </v-card-title>
      
              <v-card-text>
                <div class="mb-3">&nbsp;</div>
                <div class="mb-3">
                    <v-btn
                        color="red lighten-2"
                        dark
                        v-bind="attrs"
                        v-on="onClickAddLion"
                        >
                        {{ $t('app.Lion') }}
                    </v-btn>
                </div>

                <div class="mb-3">
                    <v-btn
                        color="red lighten-2"
                        dark
                        v-bind="attrs"
                        v-on="onClickAddElephant"
                        >
                        {{ $t('app.Elephant') }}
                    </v-btn>
                </div>

                <div class="mb-3">
                    <v-btn
                        color="red lighten-2"
                        dark
                        v-bind="attrs"
                        v-on="onClickAddCrocodile"
                        >
                        {{ $t('app.Crocodile') }}
                    </v-btn>
                </div>

              </v-card-text>
      
              <v-divider></v-divider>
      
              <v-card-actions>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
      </v-dialog>
    </div>
  </v-app>

</div>
</template>
<script>
    // Для удобной отправки запросов
    import Rest from '../../net/rest';

    // Компонент со списком клеток
    import SelectAnimalType from '../dialogs/selectanimaltype/selectanimaltype'

    export default {
        name: 'cages',
        
        //вызывается раньше чем mounted
        data: function(){return {
            /** @property {Boolean} requestSended true when request is sended*/
            requestSended: false,

            /** @property {Array} cages */
            cages: [],

            dialog: false,
        }; },
        components: {
            SelectAnimalType
        },
        //
        methods:{
            /**
             * @description Send POST request on add new empty cage
             */
            onClickAddCage() {
                this.requestSended = true;
                Rest._post({}, (data) => {this.onSuccessAddNewCage(data);}, '/addcage', (status, responseText, info, xhr, readyState) => {this.onFailAddNewCage(status, responseText, info, xhr, readyState);}, true)
            },
            /**
             * @description Клик на кнопке Добавить животное
             */
            onClickAddAnimal(id, type){
                this.currentCageId = id;
                this.currentType = type;
                this.dialog = true;
            },
            /**
             * @description Клик на кнопке Добавить льва
             */
            onClickAddLion(){
                this.requestSended = true;
                this.dialog = false;
                let data = {
                    cageId:this.currentCageId,
                    type: this.currentType
                };
                Rest._post(data, (data) => {this.onSuccessAddAnimal(data)}, '/addlion', () => {this.defaultFail(status, responseText, info, xhr, readyState)});
            },
            /**
             * @description Success add new animal
             */
            onSuccessAddAnimal(data) {
                if (this.defaultFail(data)) {
                    return;
                }
                for (i = 0; i < this.cages.length; i++) {
                    if (data.type == this.cages[i].type && this.cages[i].id == data.cage.id) {
                        this.cages[i] = data.cage;
                        break;
                    }
                }
            },
            /**
             * @description Success add new cage
             */
            onSuccessAddNewCage(data) {
                if (!this.defaultFail(data)) {
                    return;
                }
                this.cages.push(data.cage);
            },
            /**
             * @description Fail add new cage
             */
            onFailAddNewCage(status, responseText, info, xhr, readyState) {
                this.defaultFail(status, responseText, info, xhr, readyState);
            },
            /**
             * @description Fail load cages list
            */
            onFailLoadCagesList(status, responseText, info, xhr, readyState){
                this.requestSended = false;

                let data = status;
                
        		if (data && data.status && data.status == 'error') {
        			if (data.error) {
        				this.alert(data.error);
        			}
        			return false;
        		} else if ( (data && data.status && data.status != 'ok') || !data.status) {
        			this.alert( this.$t('app.DefaulErrorPageReload') );
        		}
        		return true;
            },
            /**
             * @description Success load cages list
            */
            onSuccessLoadCagesList(data){
                if (!this.onFailLoadCagesList(data)) {
                    return;
                }
                this.cages = data.cages;
            },
            /**
             * @description Стандартная обработка неуспешной отправки формы.
        	 * В случае ошибки сети или сбоя серверного приложения вызывает defaultError()
        	 * В случае ошибки серверного приложения анализирует data 
        	 *  Ожидает найти там status == 'error || success' и объект errors
        	 *  Ожидаемый формат объекта errors:
        	 *  key:String : errorMessage:String
        	 *  Для каждого ключа будет выполнен поиск инпута с таким id
        	 *   В случае успешного поиска для него будет установлен текст ошибки errorMessage
        	 * 
        	 * Можно  использовать в обработчике успешной отправки формы
        	 *  if (!this.$root.defaultFailSendFormListener(data)) {
        	 * 		return;
        	 * 	}
        	 *  @param {*} data
        	 *	@return Boolean
            */
        	defaultFail(status, responseText, info, xhr, readyState,){
                this.requestSended = false;

                let data = status;
                
        		if (data && data.status && data.status == 'error') {
        			if (data.error) {
        				this.alert(data.error);
        			}
        			return false;
        		} else if ( (data && data.status && data.status != 'ok') || !data.status) {
        			this.alert( this.$t('app.DefaultError') );
        		}
        		return true;
        	},
            /*
             * @description Сообщение об ошибке
            */
            alert(s) {
                alert(s);
            }

        }, //end methods
        //вызывается после data, поля из data видны "напрямую" как this.fieldName
        mounted() {
            Rest._token = '*****';
            Rest._get((data) => {
                this.onSuccessLoadCagesList(data);
            }, '/list', (status, responseText, info, xhr, readyState) => {
                this.onFailLoadCagesList(status, responseText, info, xhr, readyState);
            });
        }
    }
</script>