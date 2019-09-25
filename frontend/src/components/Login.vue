<template>
  <div id="login" >
    <b-row class="justify-content-md-center">
      <b-form v-on:submit.prevent="submit(user)">

      <b-form-group label="Selecione a ação que deseja!">
        <b-form-radio-group id="radios1" v-model="isCadastro" :options="options" name="radioOpenions"></b-form-radio-group>
      </b-form-group>

        <b-form-group v-if="isCadastro == true" id="nome" label="Nome:" label-for="nome">
          <b-form-input id="nome" type="text" v-model="user.name" required placeholder="Insira seu nome"></b-form-input>
        </b-form-group>

        <b-form-group id="email" label="Email:" label-for="email">
          <b-form-input id="email" type="email" v-model="user.email" required placeholder="Insira seu email"></b-form-input>
        </b-form-group>

        <b-form-group id="senha" label="Senha:" label-for="senha">
          <b-form-input id="password" type="password" v-model="user.password" required placeholder="Insira a sua senha"></b-form-input>
        </b-form-group>

        <div v-if="isCadastro == false">
          <b-button  type="submit" variant="primary" size="lg" :block="true" v-bind:disabled="!isValidLogin">
            Entrar
          </b-button>
        </div>
        <div v-else>
          <b-button  type="submit" variant="primary" size="lg" :block="true" v-bind:disabled="!isValidCreate">
            Criar
          </b-button>
        </div>

        <br>
        <g-signin-button :params="googleSignInParams" @success="onSignInSuccessg" @error="onSignInErrorg">
          <i class="fa fa-google"></i>
          <span v-if="isCadastro == false">
            Entrar com Google
          </span>
          <span v-else>
            Cadastrar com Google
          </span>
        </g-signin-button>

        <fb-signin-button :params="fbSignInParams" @success="onSignInSuccessfb" @error="onSignInErrorfb">
          <i class="fa fa-facebook"></i>
          <span v-if="isCadastro == false">
            Entrar com Facebook
          </span>
          <span v-else>
            Cadastrar com Facebook
          </span>
        </fb-signin-button>

      </b-form>
    </b-row>

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import ls from 'localStorage'

export default {
  name: 'LoginComponent',
  data () {
    return {
      isCadastro: false,
      selected: false,
      options: [
        { text: 'Logar', value: false },
        { text: 'Cadastrar', value: true }
      ],
      user: {
        name: '',
        email: '',
        password: '',
        // Campo password especifico para rede social, fiz isso para o usuário não ver
        passwordRS: ''
      },
      fbSignInParams: {
        scope: 'email,user_likes',
        return_scopes: false
      },
      googleSignInParams: {
        client_id: process.env.CLIENT_ID_GOOGLE
      }
    }
  },
  computed: {
    ...mapGetters(['getTokenAuth']),
    isValidLogin () {
      return this.user.email !== '' && this.user.password !== ''
    },
    isValidCreate () {
      return this.user.email !== '' && this.user.password !== '' && this.user.name !== ''
    }
  },
  methods: {
    ...mapActions(['logar', 'create']),
    // facebook
    async onSignInSuccessfb (response) {
      const self = this
      self.user.passwordRS = response.authResponse.accessToken
      /* eslint-disable rule-name */
      const fb = new Promise(function (resolve, reject) {
        FB.api('/me', { fields: 'name, email' }, dude => {
          self.user.name = dude.name
          self.user.email = dude.email
          resolve(self.user)
        })
      })
      /* eslint-enable rule-name */

      await fb.then(e => {
        this.submit(e)
      })
    },
    onSignInErrorfb (error) {
      this.$toast.bottom('Erro ao logar no facebook')
      console.error(error)
    },
    // google
    onSignInSuccessg (googleUser) {
      this.user.name = googleUser.getBasicProfile().ig
      this.user.email = googleUser.getBasicProfile().U3
      this.user.passwordRS = googleUser.Zi.access_token
      this.submit(this.user)
    },
    onSignInErrorg (error) {
      this.$toast.bottom('Erro ao logar no google')
      console.error(error)
    },
    validarAuth (user) {
      this.logar(user)
        .then(() => {
          ls.setItem('ul', user.email)
          ls.setItem('TOKEN', JSON.stringify(this.getTokenAuth))
        })
        .then(() => {
          const token = JSON.parse(ls.getItem('TOKEN'))
          if (token !== null || token !== '') {
            this.$router.push('/dashboard')
          }
        })
        .catch(e => {
          this.$toast.bottom('Erro ao logar, certifique que o usuário existe')
          this.resetUser()
          console.log(e)
        })
    },
    submit (user) {
      if (this.isCadastro === false) {
        this.validarAuth(user)
      } else {
        this.create(user)
          .then(t => {
            this.validarAuth(user)
          })
          .catch(e => {
            this.$toast(e.response.data)
            console.error(e.response)
          })
      }
    },
    resetUser () {
      this.user.name = ''
      this.user.email = ''
      this.user.password = ''
      this.user.passwordRS = ''
    }
  }
}
</script>

<style>
.fb-signin-button {
  /* This is where you control how the button looks. Be creative! */
  display: inline-block;
  padding: 4px 8px;
  border-radius: 3px;
  background-color: #4267b2;
  color: #fff;
  cursor: pointer;
}

.g-signin-button {
  /* This is where you control how the button looks. Be creative! */
display: inline-block;
  padding: 4px 8px;
  border-radius: 3px;
  background-color: #dd4b39;
  color: #fff;
  cursor: pointer;
}

</style>
