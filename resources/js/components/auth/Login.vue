<template>
  <v-layout
    align-center
    justify-center
  >
    <v-flex shrink>
      <v-form @submit.prevent="login">
        <v-text-field
          label="E-mail"
          v-model="form.email"
          type="email"
          required
        ></v-text-field>
        <span class="red--text" v-if="error">
          {{ error }}
        </span>

        <v-text-field
          label="Password"
          v-model="form.password"
          type="password"
          required
        ></v-text-field>

        <v-btn
          type="submit"
          color="green"
        >
          Login
        </v-btn>
      </v-form>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      error: null,
    };
  },

  methods: {
    login() {
      axios.post('/api/auth/login', this.form)
      .then((res) => {
        User.responseAfterLogin(res);
        window.location = '/forum';
      })
      .catch((error) => this.error = 'Invalid credentials');
    },
  },
};
</script>
