<template>
  <div>
  <h4>Информация по книге</h4>
  <br/>
  <vs-table :data="dataBook">

    <template slot="thead">
      <vs-th>Название</vs-th>
      <vs-th>Год выпуска</vs-th>
      <vs-th>Рейтинг</vs-th>
      <vs-th>Автор</vs-th>
    </template>

    <template slot-scope="{data}">
      <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

        <vs-td>
          {{ tr.title }}
        </vs-td>

        <vs-td>
          {{ tr.year }}
        </vs-td>

        <vs-td>
          {{ tr.rating }}
        </vs-td>

        <vs-td>
          <a :href="'/author/' + tr.author.id">{{ tr.author.name }}</a>
        </vs-td>

      </vs-tr>
    </template>

  </vs-table>
  </div>
</template>

<script>
import axios from '@/axios.js'

export default {
  data() {
    return {
      dataBook: []
    }
  },
  mounted () {
    axios.get('/api/booklist/' + this.$route.params.id)
      .then((response) => {
        this.dataBook = [response.data]
      })
      .catch((error) => {})
  }
}
</script>
