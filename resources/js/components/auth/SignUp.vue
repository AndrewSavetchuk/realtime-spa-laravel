<template>
  <v-layout
    align-center
    justify-center
  >
    <v-flex shrink>
      <v-form @submit.prevent="signUp">
        <v-text-field
          v-model="form.name"
          label="Name"
          type="text"
          required
        />
        <div
          v-if="errors.name"
          class="red--text"
        >
          {{ errors.name[0] }}
        </div>

        <v-text-field
          v-model="form.email"
          label="E-mail"
          type="email"
          required
        />
        <div
          v-if="errors.email"
          class="red--text"
        >
          {{ errors.email[0] }}
        </div>

        <v-text-field
          v-model="form.password"
          label="Password"
          type="password"
          required
        />
        <div
          v-if="errors.password"
          class="red--text"
        >
          {{ errors.password[0] }}
        </div>

        <v-text-field
          v-model="form.password_confirmation"
          label="Password Confirmation"
          type="password"
          required
        />

        <v-btn
          type="submit"
          color="green"
        >
          Sign Up
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
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: {},
    };
  },

  methods: {
    signUp() {
      axios.post('/api/auth/signup', this.form).then((res) => {
        User.responseAfterLogin(res);
        window.location = '/forum';
      }).catch((error) => this.errors = error.data.errors);
    },
  },
};
</script>
