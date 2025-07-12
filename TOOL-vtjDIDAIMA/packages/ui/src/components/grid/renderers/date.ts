import { h, createTextVNode } from 'vue';
import type { RendererOptions } from 'vxe-table';
import { sharedFilterOptions } from './shared';
import DateEdit from './components/DateEdit.vue';
import DateFilter from './components/DateFilter.vue';

const renderCell = (_renderOpts: any, params: any) => {
  const { row, column } = params;
  return [createTextVNode(row[column.field] || '')];
};

export const XDate: RendererOptions = {
  cellClassName: 'x-grid__edit',
  autofocus: '.el-input__inner',
  renderEdit(renderOpts, params) {
    return [h(DateEdit, { params, renderOpts })];
  },
  renderCell: renderCell,
  renderDefault: renderCell,
  ...sharedFilterOptions,
  renderFilter(renderOpts, params) {
    return [h(DateFilter, { params, renderOpts })];
  }
};
