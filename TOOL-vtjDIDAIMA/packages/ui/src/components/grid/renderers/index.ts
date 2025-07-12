import type { VXETableCore } from 'vxe-table';
import { XInput } from './input';
import { XActions } from './actions';
import { XDate } from './date';
import { XImage } from './image';
import { XLink } from './link';
import { XSelect } from './select';
import { XTag } from './tag';
import { XText } from './text';
import { XPicker } from './picker';
import { XNumber } from './number';
import { XGrider } from './grid';

import { handleClerEdit, handleClearFilter } from './interceptors';

export const RenderPlugin = {
  install(vxetable: VXETableCore) {
    vxetable.renderer.mixin({
      XInput,
      XActions,
      XDate,
      XImage,
      XLink,
      XSelect,
      XTag,
      XText,
      XPicker,
      XNumber,
      XGrider
    });

    vxetable.interceptor.add('event.clearFilter', handleClearFilter);
    vxetable.interceptor.add('event.clearEdit', handleClerEdit);
  }
};
