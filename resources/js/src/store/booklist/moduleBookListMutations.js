export default {
  ADD_ITEM (state, item) {
    state.books.unshift(item)
  },
  SET_BOOKS (state, books) {
    state.books = books
  },
  // SET_LABELS(state, labels) {
  //   state.eventLabels = labels
  // },
  UPDATE_BOOK (state, book) {
    const bookIndex = state.books.findIndex((p) => p.id === book.id)
    Object.assign(state.books[bookIndex], book)
  },
  REMOVE_ITEM (state, itemId) {
    const ItemIndex = state.books.findIndex((p) => p.id === itemId)
    state.books.splice(ItemIndex, 1)
  }
}
