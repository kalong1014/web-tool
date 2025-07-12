import {
  defineComponent,
  h,
  computed,
  type ComputedRef,
  type DefineComponent,
  isVNode,
  type MaybeRef,
  unref,
  markRaw,
  getCurrentInstance
} from 'vue';
import { type IconParam, XIcon, type IconProps } from '../components';

export function useIconProps(
  iconRef: MaybeRef<IconParam | undefined>
): ComputedRef<IconProps | null> {
  const instance = getCurrentInstance();
  return computed(() => {
    const icon = unref(iconRef);
    if (icon) {
      if (
        typeof icon === 'string' ||
        (icon as DefineComponent).setup ||
        (icon as DefineComponent).render ||
        isVNode(icon)
      ) {
        const app = instance?.appContext.app;
        return {
          icon: typeof icon === 'string' ? app?.component(icon) || icon : icon
        } as IconProps;
      } else {
        return icon as IconProps;
      }
    }
    return null;
  });
}

export function useIcon(
  icon: MaybeRef<IconParam | undefined>
): Record<string, any> | undefined {
  const props = useIconProps(icon);
  return props.value
    ? markRaw(defineComponent({ render: () => h(XIcon, props.value) }))
    : undefined;
}
