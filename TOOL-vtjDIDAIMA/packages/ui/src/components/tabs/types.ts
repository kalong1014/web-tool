import type { PropType } from 'vue';
import type { ComponentPropsType } from '../shared';
import type { IconParam, ActionProps, ActionMenuItem } from '../';

export interface TabsItem {
  label: string;
  name?: string | number;
  icon?: IconParam;
  // name 别名，为统一命名
  value?: string | number;
  // 附加数据
  data?: any;
  disabled?: boolean;
  closable?: boolean;
  lazy?: boolean;
  actions?: ActionProps[];
  // 加载自定义组件
  component?: any;
  // 组件参数
  props?: Record<string, any>;

  /**
   * 自定义内容插槽名称
   */
  slot?: string;
}

export const tabsProps = {
  items: {
    type: Array as PropType<TabsItem[]>,
    default() {
      return [];
    }
  },
  border: {
    type: Boolean
  },
  fit: {
    type: Boolean
  },
  align: {
    type: String as PropType<'left' | 'center' | 'right'>
  }
};

export type TabsProps = ComponentPropsType<typeof tabsProps>;

export type TabsEmits = {
  actionClick: [props: ActionProps];
  actionCommand: [item: ActionMenuItem];
};
