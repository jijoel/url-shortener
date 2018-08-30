<template>
<div>
  <h2 class="pl-2 pt-2 pb-4 headline">
    Joel's Nifty URL Shortener
  </h2>

  <v-card class="primary lighten2">
    <v-container grid-list-md>
      <v-layout row wrap justify-center>
        <v-flex xs12 sm10 md8>
          <v-card-title class="display-1 white--text">
            Simplify Your Links
          </v-card-title>
          <v-card-text>

            <v-form @submit.prevent="submit">
              <v-layout col wrap>
                <v-flex xs12 sm10>

                  <v-text-field
                    solo
                    name="url"
                    v-model="url"
                    placeholder="Your original URL here"
                    data-vv-name="url"
                    v-validate="'required|url|max:255'"
                    :error-messages="errors.collect('url')"
                    hint="All urls are public and can be accessed by anyone"
                    persistent-hint
                  ></v-text-field>

                </v-flex>
                <v-flex xs12 sm2>
                  <v-btn
                    :disabled="hasErrors"
                    class="primary--text"
                    type="submit"
                  >
                    Shorten Url
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-form>

            <v-layout class="pt-4" justify-center v-if="short">
              <v-flex xs12 md9>
                <v-card class="grey lighten-4">
                  <v-layout col>
                    <v-flex xs10>
                      <div class="pl-3 pt-1 grey--text">
                        Your Short URL:
                      </div>
                      <v-card-text class="headline pt-0">
                        {{ shortUrl }}
                      </v-card-text>
                    </v-flex>
                    <v-flex xs2 class="pt-3">
                      <v-tooltip top>
                        <v-btn
                          v-clipboard:copy="shortUrl"
                          slot="activator"
                          color="white"
                          icon
                        >
                          <v-icon>input</v-icon>
                        </v-btn>
                        <span>Copy to clipboard</span>
                      </v-tooltip>
                    </v-flex>
                  </v-layout>
                </v-card>
              </v-flex>
            </v-layout>

          </v-card-text>
        </v-flex>
      </v-layout>
    </v-container>
  </v-card>

</v-form>
</div>
</template>

<script>

export default {

  name: 'ShortUrlComponent',

  data() {
    return {
      url: '',
      short: '',
    }
  },

  computed: {
    hasErrors() {
      return this.$validator.errors.items.length > 0
    },

    shortUrl() {
      return window.location.href + this.short
    },

    postUrl() {
      return (this.url.indexOf('http') === -1)
        ? 'http://' + this.url
        : this.url
    }
  },

  methods: {
    submit() {
      this.$validator.validateAll()
      if (this.hasErrors) {
        return
      }

      axios.post('/', {
        url: this.postUrl
      })
      .then(response => {
        this.short = response.data.short
      })
      .catch(error => {
        this.handleError(error.response)
      })
    },

    handleError(response) {
      switch(response.status) {
        case 422: this.loadValidationErrors(response.data.errors)
      }
    },

    loadValidationErrors(invalid) {
      Object.keys(invalid).map((field) => {

        this.$validator.errors.add({
          field: field,
          msg: invalid[field].join(),
        })
      })
    },
  },

  watch: {
    url(val) {
      this.short = ''
    }
  },

}
</script>
