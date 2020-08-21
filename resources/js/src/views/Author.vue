<template>
  <div>
  <h4>Информация по автору</h4>
  <br/>
  <vs-table :data="dataAuthor">

    <template slot="thead">
      <vs-th>Автор</vs-th>
      <vs-th>Год рождения</vs-th>
      <vs-th>Рейтинг</vs-th>
      <vs-th>Кол-во книг</vs-th>
    </template>

    <template slot-scope="{data}">
      <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

        <vs-td>
          {{ tr.name }}
        </vs-td>

        <vs-td>
          {{ tr.year }}
        </vs-td>

        <vs-td>
          {{ tr.rating }}
        </vs-td>

        <vs-td>
          {{ tr.count_books }}
        </vs-td>

      </vs-tr>
    </template>

  </vs-table>
  <br/>
  <h4>Книги автора</h4>
  <br/>
  <vs-table :data="dataBooks">

    <template slot="thead">
      <vs-th>Название</vs-th>
      <vs-th>Год выпуска</vs-th>
      <vs-th>Рейтинг</vs-th>
    </template>

    <template slot-scope="{data}">
      <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

        <vs-td>
          <a :href="'/book/' + tr.id">{{ tr.title }}</a>
        </vs-td>

        <vs-td>
          {{ tr.year }}
        </vs-td>

        <vs-td>
          {{ tr.rating }}
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
      dataAuthor: [],
      dataBooks: [],
    }
  },
  mounted () {
    axios.get('/api/authorlist/' + this.$route.params.id)
      .then((response) => {
        this.dataAuthor = [response.data]
        this.dataBooks = response.data.books
        //console.log(this.dataAuthor)
      })
      .catch((error) => {})
  }
}
</script>
