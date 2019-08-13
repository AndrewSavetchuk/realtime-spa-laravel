<template>
  <v-card class="mb-3">
    <v-card-title primary-title>
      <div>
        <h3 class="headline mb-0">
          <router-link
            :to="{ name: 'forum-single', params: { slug: question.slug }}"
          >
            {{ question.title }}
          </router-link>
        </h3>
      </div>
    </v-card-title>
    <v-card-text>
      <div class="grey--text">
        {{ question.user }} asked {{ question.created_at }}
      </div>
      {{ question.body }}
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: [
    'question',
  ],
};
</script>
