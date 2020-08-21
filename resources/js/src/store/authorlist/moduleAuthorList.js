import state from './moduleAuthorListState.js'
import mutations from './moduleAuthorListMutations.js'
import actions from './moduleAuthorListActions.js'
import getters from './moduleAuthorListGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
