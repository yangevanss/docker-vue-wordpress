import Icon from '@/js/components/Icon.vue'

const requireAll = requireContext => requireContext.keys().map(requireContext)
const req = require.context('@/assets/icons', true, /\.svg$/)
requireAll(req)

export default Icon
