import type { PropType } from 'vue';
import type { QueryFormItems } from './types';

export const queryFormProps = {
  collapsible: {
    type: Boolean,
    default: true
  },
  items: {
    type: Array as PropType<QueryFormItems>
  },
  inlineColumns: {
    type: Number,
    default: 4
  },
  disabled: {
    type: Boolean
  }
};
