import state from './moduleBookListState.js'
import mutations from './moduleBookListMutations.js'
import actions from './moduleBookListActions.js'
import getters from './moduleBookListGetters.js'

export default {
  isRegistered: false,
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}

