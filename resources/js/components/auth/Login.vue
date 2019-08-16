<template>
  <v-layout
    align-center
    justify-center
  >
    <v-flex shrink>
      <v-form @submit.prevent="login">
        <v-text-field
          v-model="form.email"
          label="E-mail"
          type="email"
          required
        />
        <div
          v-if="error"
          class="red--text"
        >
          {{ error }}
        </div>

        <v-text-field
          v-model="form.password"
          label="Password"
          type="password"
          required
        />

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
      axios.post('/api/auth/login', this.form).then((res) => {
        User.responseAfterLogin(res);
        window.location = '/forum';
      }).catch((error) => this.error = 'Invalid credentials');
    },
  },
};
</script>
