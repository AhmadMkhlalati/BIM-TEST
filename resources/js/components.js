import Vue from 'vue'
import Input from "./Components/Forms Components/Input.vue"
import Button from "./Components/Forms Components/Button.vue"
import LoginForm from "./Components/Forms/LoginForm.vue"
import DialogAlert from "./Components/Forms/DialogAlert.vue"
import Table from "./Components/Table.vue"
import Title from "./Components/Title.vue"
import AutoComplete from "./Components/Forms Components/AutoComplete.vue"
import Date from "./Components/Forms Components/Date.vue"
import Switcher from "./Components/Forms Components/Switcher.vue"
import TextArea from "./Components/Forms Components/TextArea.vue"

import TransactionForm from "./Components/Forms/TransactionForm.vue"
import { Link } from '@inertiajs/vue2'
import PaymentForm from "./Components/Forms/PaymentForm.vue";


Vue.component('Input', Input)
Vue.component('Button', Button)
Vue.component('LoginForm', LoginForm)
Vue.component('DialogAlert', DialogAlert)
Vue.component('Table', Table)
Vue.component('Title', Title)
Vue.component('AutoComplete', AutoComplete)
Vue.component('Date', Date)
Vue.component('Switcher', Switcher)
Vue.component('TextArea', TextArea)


Vue.component('Link', Link)

Vue.component('TransactionForm', TransactionForm)
Vue.component('PaymentForm', PaymentForm)



export default {}
