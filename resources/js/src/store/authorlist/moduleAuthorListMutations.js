export default {
  ADD_ITEM (state, item) {
    state.authors.unshift(item)
  },
  SET_AUTHORS (state, authors) {
    state.authors = authors
  },
  // SET_LABELS(state, labels) {
  //   state.eventLabels = labels
  // },
  UPDATE_AUTHOR (state, author) {
    const authorIndex = state.authors.findIndex((p) => p.id === author.id)
    Object.assign(state.authors[authorIndex], author)
  },
  REMOVE_ITEM (state, itemId) {
    const ItemIndex = state.authors.findIndex((p) => p.id === itemId)
    state.authors.splice(ItemIndex, 1)
  }
}
