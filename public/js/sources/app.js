window.Vue = require('vue');
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'


const router = new VueRouter({})

Vue.use(Vuetify)
const opts = {}


const vuetify= new Vuetify({  })

// export default new Vuetify(opts)


// require('./vendor/bootstrap4.2.1.min.js');
// import './vendor/bootstrap4.2.1.min.css'

//For REST request server
// require('../../landlib/net/rest.js');

//Интернациализация
import VueI18n  from 'vue-i18n';
import locales  from './vue-i18n-locales';

const i18n = new VueI18n({
    locale: 'ru', // set locale
    messages:locales, // set locale messages
});
//end Интернациализация

// Компонент со списком клеток
import cages from './views/cages/cages.vue'



window.app = new Vue({
    i18n : i18n,
    el: '#vueapp',
    router: router,
    vuetify:vuetify,

    components: {
        cages
    },

   // router,
   /**
    * @property Данные приложения
   */
   data: {
     /** @property {} */
     // testvuework : 'Are you sure'
   },
   /**
    * @description Событие, наступающее после связывания el с этой логикой
   */
   mounted() {
        
		// this.localizeParams();
        // Rest._token = this._getToken();
        // this.alert('mounted!');
   },
   computed:{
		
   },
   /**
    * @property methods эти методы можно указывать непосредственно в @ - атрибутах
   */
   methods:{
	
    
	/**
     * @description 
     * @param {Event} evt
    */
   on(evt) {
		if (this.requestedArticleId > 0) {
			this.alert(this.$t('app.Other_article_requested_for_edit'));
			return;
		}
		this.requestedArticleId = $(evt.target).attr('data-id');
		$('#spin' + this.requestedArticleId).toggleClass('d-none');
		this.$root._get((d) => {this.onSuccessGetArticle(d);}, `/p/article/jn/?id=${this.requestedArticleId}`, (a, b, c) => {this.onFailGetArticle(a, b, c);} );
    },
    onClickAddLeo() {
        alert('Hello! Ya dobafflyu Liva!');
    },
	/**
     * @description Success example
	 * @param {Object} data
	*/
	onSuccess(data) {
		if (!this.onFailGetArticle(data)) {
			return;
		}
		this.setArticleId(data.id);
		this.$refs.articleform.setArticleData(data);
		setTimeout(() => {
			this.setDataChanges(false);
		}, 1000);
		$('#edit-tab').tab('show');
	},
	/**
     * @description Failed request article data for edit
	 * @return Boolean
	*/
	onFailGetArticle(data, b ,c) {
		$('#spin' + this.requestedArticleId).toggleClass('d-none');
		this.requestedArticleId = 0;
		return this.defaultFailSendFormListener(data, b ,c);
	},
    
    
    /**
     * @description Alert replace
     * @param {Boolean} isVisible
    */
    alert(s) {
        let id = '#appAlertDlg';
        //this.b4AlertDlgParams.title = this.$t('app.Information');
        this.b4AlertDlgParams.body = s;
        this.b4AlertDlgParams.onOk = {
            f : () => { $(id).modal('hide'); },
            context : this
        };
        $(id).modal('show');
    },
    
	
    /**
     * @description Тут локализация некоторых параметров, которые не удается локализовать при инициализации
     */
    localizeParams() {
        //Текст на кнопках диалога подтверждения действия
        this.b4ConfirmDlgParams.btnCancelText = this.$t('app.Cancel');
		this.b4ConfirmDlgParams.btnOkText = this.$t('app.OK');
		this.b4ConfirmDlgParams.body = this.$t('app.Click_Ok_button_for_continue');
        
        //Текст на кнопках диалога с информацией
		this.b4AlertDlgParams.title = this.$t('app.Information');
	},
    _getToken() {
        let ls = document.getElementsByTagName('meta'), i;
        for (i = 0; i < ls.length; i++) {
            if (ls[i].getAttribute('name') == 'apptoken') {
                return ls[i].getAttribute('content');
            }
        }
        return '';
    },
	/**
     * @description Показ алерта с ошибкой по умолчанию
    */
	defaultError() {
		this.alert( this.$t('app.DefaultError') );
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
	 *  @param {*} b
	 *  @param {*} c
	 *	@return Boolean
    */
	defaultFailSendFormListener(data, b, c){
		if (data.status == 'error') {
			if (data.errors) {
				let i, jEl;
				for (i in data.errors) {
					jEl = $('#' + i);
					if (jEl[0]) {
						this.formInputValidator.viewSetError(jEl, data.errors[i]);
					}
				}
			}
			return false;
		} else if (data.status != 'ok') {
			this.defaultError();
		}
		return true;
	},
    /**
     * @description Индексирует массив по указанному полю
     * @param {Array} data
     * @param {String} id = 'id'
     * @return Object
    */
    storage(key, data) {
        var L = window.localStorage;
        if (L) {
            if (data === null) {
                L.removeItem(key);
            }
            if (!(data instanceof String)) {
                data = JSON.stringify(data);
            }
            if (!data) {
                data = L.getItem(key);
                if (data) {
                    try {
                        data = JSON.parse(data);
                    } catch(e){;}
                }
            } else {
                L.setItem(key, data);
            }
        }
        return data;
    },
    /**
     * @return String title
    */
    getTitle(){
        return document.getElementsByTagName('title')[0].innerHTML.trim();
    }
   }//end methods

}).$mount('#vueapp');
