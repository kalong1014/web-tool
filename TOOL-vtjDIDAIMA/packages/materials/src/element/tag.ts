import type { MaterialDescription } from '@vtj/core';
const Tag: MaterialDescription[] = [
  {
    name: 'ElTag',
    label: '标签',

    doc: 'https://element-plus.org/zh-CN/component/tag.html',
    categoryId: 'data',
    package: 'element-plus',
    props: [
      {
        name: 'type',
        defaultValue: 'primary',
        options: ['primary', 'success', 'info', 'warning', 'danger'],
        setters: 'SelectSetter'
      },
      {
        name: 'closable',
        defaultValue: false,
        setters: 'BooleanSetter'
      },
      {
        name: 'disable-transitions',
        defaultValue: false,
        label: '渐变动画',
        setters: 'BooleanSetter'
      },
      {
        name: 'hit',
        defaultValue: false,
        setters: 'BooleanSetter'
      },
      {
        name: 'color',
        defaultValue: '',
        setters: 'ColorSetter'
      },
      {
        name: 'size',
        defaultValue: 'default',
        options: ['large', 'default', 'small'],
        setters: 'SelectSetter'
      },
      {
        name: 'effect',
        defaultValue: 'light',
        options: ['dark', 'light', 'plain'],
        setters: 'SelectSetter'
      },
      {
        name: 'round',
        defaultValue: false,
        setters: 'BooleanSetter'
      }
    ],
    events: ['click', 'close'],
    slots: ['default'],
    snippet: {
      children: '标签一'
    }
  },
  {
    name: 'ElCheckTag',
    label: '可选中的标签',

    categoryId: 'data',
    package: 'element-plus',
    props: [
      {
        name: 'checked',
        defaultValue: false,
        setters: 'BooleanSetter'
      },
      {
        name: 'disabled',
        defaultValue: false,
        setters: 'BooleanSetter'
      },
      {
        name: 'type',
        label: 'type',
        title: 'CheckTag 类型',
        setters: 'SelectSetter',
        options: ['primary', 'success', 'info', 'warning', 'danger'],
        defaultValue: 'primary'
      }
    ],
    events: ['change', 'update:checked'],
    slots: ['default'],
    snippet: {
      children: '标签一'
    }
  }
];

export default Tag;
