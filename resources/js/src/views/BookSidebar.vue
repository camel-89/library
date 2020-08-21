<template>
  <vs-sidebar click-not-close position-right parent="body" default-index="1" color="primary" class="add-new-data-sidebar items-no-padding" spacer v-model="isSidebarActiveLocal">
    <div class="mt-6 flex items-center justify-between px-6">
        <h4>{{ Object.entries(this.data).length === 0 ? "Добавление" : "Изменение" }} книги</h4>
        <feather-icon icon="XIcon" @click.stop="isSidebarActiveLocal = false" class="cursor-pointer"></feather-icon>
    </div>
    <vs-divider class="mb-0"></vs-divider>

    <component :is="scrollbarTag" class="scroll-area--data-list-add-new" :settings="settings" :key="$vs.rtl">

      <div class="p-6">

        <!-- Название -->
        <vs-input label="Название" v-model="dataTitle" class="mt-5 w-full" name="item-name" v-validate="'required'" />
        <span class="text-danger text-sm" v-show="errors.has('item-name')">{{ errors.first('item-name') }}</span>

        <!-- Автор -->
        <vs-select v-model="dataAuthor" label="Автор" class="mt-5 w-full" name="item-category" v-validate="'required'">
          <vs-select-item :key="item.value" :value="item.id" :text="item.name" v-for="item in dataAuthors" />
        </vs-select>
        <span class="text-danger text-sm" v-show="errors.has('item-category')">{{ errors.first('item-category') }}</span>

        <!-- Год выпуска -->
        <vs-input label="Год выпуска" v-model="dataYear" class="mt-5 w-full" name="item-year" v-validate="'required'" />
        <span class="text-danger text-sm" v-show="errors.has('item-year')">{{ errors.first('item-year') }}</span>

        <!-- Рейтинг -->
        <vs-input label="Рейтинг" v-model="dataRating" class="mt-5 w-full" name="item-rating" v-validate="'required'" />
        <span class="text-danger text-sm" v-show="errors.has('item-rating')">{{ errors.first('item-rating') }}</span>

      </div>
    </component>

    <div class="flex flex-wrap items-center p-6" slot="footer">
      <vs-button class="mr-6" @click="submitData" :disabled="!isFormValid">Сохранить</vs-button>
      <vs-button type="border" color="danger" @click="isSidebarActiveLocal = false">Отмена</vs-button>
    </div>
  </vs-sidebar>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import axios from '@/axios.js'

export default {
  props: {
    isSidebarActive: {
      type: Boolean,
      required: true
    },
    data: {
      type: Object,
      default: () => {}
    }
  },
  components: {
    VuePerfectScrollbar
  },
  data () {
    return {

      dataId: null,
      dataTitle: '',
      dataAuthor: null,
      dataYear: '',
      dataRating: 0.00,

      dataAuthors: [],

      order_status_choices: [
        {text:'Pending', value:'pending'},
        {text:'Canceled', value:'canceled'},
        {text:'Delivered', value:'delivered'},
        {text:'On Hold', value:'on_hold'}
      ],
      settings: { // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      }
    }
  },
  watch: {
    isSidebarActive (val) {
      if (!val) return
      if (Object.entries(this.data).length === 0) {
        this.initValues()
        this.$validator.reset()
      } else {
        const { id, title, author_id, year, rating } = JSON.parse(JSON.stringify(this.data))
        this.dataId = id
        this.dataTitle = title
        this.dataAuthor = author_id
        this.dataYear = year
        this.dataRating = rating
        this.initValues()
      }
      // Object.entries(this.data).length === 0 ? this.initValues() : { this.dataId, this.dataTitle, this.dataAuthor, this.dataYear, this.dataRating } = JSON.parse(JSON.stringify(this.data))
    }
  },
  computed: {
    isSidebarActiveLocal: {
      get () {
        return this.isSidebarActive
      },
      set (val) {
        if (!val) {
          this.$emit('closeSidebar')
          // this.$validator.reset()
          // this.initValues()
        }
      }
    },
    isFormValid () {
      return !this.errors.any() && this.dataTitle && this.dataAuthor && this.dataRating > 0
    },
    scrollbarTag () { return this.$store.getters.scrollbarTag }
  },
  mounted() {
    axios.get('/api/authorlist')
      .then((response) => {
        this.dataAuthors = response.data
      })
      .catch((error) => { reject(error) })
  },
  methods: {
    initValues () {
      if (this.data.id) return
      this.dataId = null
      this.dataTitle = ''
      this.dataAuthor = null
      this.dataYear = ''
      this.dataRating = 0.00
      this.dataImg = null
    },
    submitData () {
      this.$validator.validateAll().then(result => {
        if (result) {
          const obj = {
            id: this.dataId,
            title: this.dataTitle,
            author_id: this.dataAuthor,
            year: this.dataYear,
            rating: this.dataRating
          }

          if (this.dataId !== null && this.dataId >= 0) {
            this.$store.dispatch('BookList/updateItem', obj).catch(err => { console.error(err) })
          } else {
            delete obj.id
            //obj.popularity = 0
            this.$store.dispatch('BookList/addItem', obj).catch(err => { console.error(err) })
          }

          this.$emit('closeSidebar')
          this.initValues()
        }
      })
    }
  }
}
</script>

<style lang="scss" scoped>
.add-new-data-sidebar {
  ::v-deep .vs-sidebar--background {
    z-index: 52010;
  }

  ::v-deep .vs-sidebar {
    z-index: 52010;
    width: 400px;
    max-width: 90vw;

    .img-upload {
      margin-top: 2rem;

      .con-img-upload {
        padding: 0;
      }

      .con-input-upload {
        width: 100%;
        margin: 0;
      }
    }
  }
}

.scroll-area--data-list-add-new {
    // height: calc(var(--vh, 1vh) * 100 - 4.3rem);
    height: calc(var(--vh, 1vh) * 100 - 16px - 45px - 82px);

    &:not(.ps) {
      overflow-y: auto;
    }
}
</style>
