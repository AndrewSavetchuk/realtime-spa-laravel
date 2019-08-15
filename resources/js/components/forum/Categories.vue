<template>
  <v-layout
    align-center
    justify-center
  >
    <div>
      <v-form
        @submit.prevent="submit"
        class="mb-5"
      >
        <v-text-field
          v-model="form.title"
          label="Category title"
          type="text"
          required
        />
        <div class="red--text" v-if="errors.title">
          {{ errors.title[0] }}
        </div>

        <v-btn
          v-if="!editSlug"
          type="submit"
          color="teal"
          :disabled="formIsValid"
        >
          Create
        </v-btn>
        <v-btn
          v-else
          type="submit"
          color="teal"
          :disabled="formIsValid"
        >
          Update
        </v-btn>
        <v-btn
          v-if="form.title"
          type="button"
          @click.prevent="editSlug = null;form.title = ''"
        >
          Cancel
        </v-btn>
      </v-form>
      <v-card
        class="mb-5"
      >
        <v-toolbar>
          <v-toolbar-title>
            Categories
          </v-toolbar-title>
        </v-toolbar>

        <v-list>
          <div
            v-for="(category, index) in categories"
            :key="category.id"
          >
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  {{ category.title }}
                </v-list-item-title>
              </v-list-item-content>
              <v-list-item-action>
                <v-btn
                  small
                  text
                  @click="edit(index)"
                >
                  Edit
                </v-btn>
              </v-list-item-action>
              <v-list-item-action
                class="ml-0"
              >
                <v-btn
                  small
                  text
                  color="red"
                  @click="destroy(category, index)"
                >
                  Delete
                </v-btn>
              </v-list-item-action>
            </v-list-item>
            <v-divider
              v-if="index !== categories.length - 1"
            />
          </div>
        </v-list>
      </v-card>
    </div>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: '',
      },
      categories: null,
      editSlug: null,
      errors: {},
    };
  },

  computed: {
    formIsValid() {
      return !this.form.title;
    },
  },

  created() {
    this.fetchCategories();
  },

  methods: {
    fetchCategories() {
      axios.get('/api/categories').then((res) => this.categories = res.data.data);
    },

    submit() {
      if (!this.editSlug) {
        this.create();
      } else {
        this.update();
      }
    },

    create() {
      axios.post('/api/categories', this.form).then((res) => {
        this.categories.unshift(res.data);
        this.form.title = '';
      }).catch((error) => this.errors = error.data.errors);
    },

    update() {
      axios.patch(`/api/categories/${this.editSlug}`, this.form).then((res) => {
        const category = _.findIndex(this.categories, { slug: this.editSlug });
        this.categories[category].title = this.form.title;
        this.form.title = '';
        this.editSlug = null;
      }).catch((error) => this.errors = error.data.errors);
    },

    destroy(category, index) {
      axios.delete(`/api/categories/${category.slug}`).then(() => {
        this.categories.splice(index, 1);
      });
    },

    edit(index) {
      this.form.title = this.categories[index].title;
      this.editSlug = this.categories[index].slug;
    },
  },
};
</script>
