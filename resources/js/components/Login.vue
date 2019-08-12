<template>
  <v-form @submit.prevent="login">
    <v-text-field
      label="E-mail"
      v-model="form.email"
      type="email"
      required
    ></v-text-field>

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
</template>

<script>
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      loginUrl: '/api/auth/login',
    };
  },

  methods: {
    login() {
      axios.post(this.loginUrl, this.form)
      .then((res) => {
        console.log(res.data);
      })
      .catch((error) => {
        console.log(error.response.data);
      });
    },
  },
};
</script>
