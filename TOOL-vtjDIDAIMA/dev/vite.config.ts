import { createViteConfig } from '@vtj/cli';
import { createDevTools } from '@vtj/local';
import fs from 'fs-extra';
import proxy from './proxy.config';
const isExtension = !!process.env.Extension;
const isUni = !!process.env.uni;

const UniUI = {
  name: 'transform-file',
  load(id: string) {
    if (id.includes('SubView.vue')) {
      const content = fs.readFileSync(id, 'utf-8');
      // console.log(content);

      return content.replace('button', 'Button');
    }
  }
};

function creator() {
  if (isExtension) {
    return {
      lib: true,
      outDir: 'public/extension',
      dts: false,
      entry: 'src/extension/index.ts',
      library: 'VtjExtension',
      formats: ['umd'],
      copyPublicDir: false,
      external: [
        '@vtj/pro',
        'vue',
        '@vtj/icons',
        '@vtj/utils',
        '@vtj/ui',
        'element-plus'
      ],
      externalGlobals: {
        vue: 'Vue',
        '@vtj/pro': '__VTJ_PRO__',
        '@vtj/icons': 'VtjIcons',
        '@vtj/utils': 'VtjUtils',
        '@vtj/ui': 'VtjUI',
        'element-plus': 'ElementPlus'
      }
    };
  }

  return {
    proxy,
    host: '0.0.0.0',
    base: './',
    emptyOutDir: isUni ? false : true,
    pages: isUni
      ? {
          main: 'uni/index.html'
        }
      : {
          main: 'index.html'
        },
    https: false,
    legacy: false,
    elementPlus: false,
    babel: false,
    staticDirs: ['../packages'],
    optimizeDeps: [
      'monaco-editor',
      'monaco-editor/esm/vs/editor/editor.worker',
      'monaco-editor/esm/vs/language/json/json.worker',
      'monaco-editor/esm/vs/language/css/css.worker',
      'monaco-editor/esm/vs/language/html/html.worker',
      'monaco-editor/esm/vs/language/typescript/ts.worker'
    ],
    plugins: [
      createDevTools({
        hm: null,
        link: false,
        copy: false,
        devMode: true,
        packagesDir: '../packages'
      }),

      isUni ? UniUI : undefined
    ],
    alias: isUni
      ? {
          vue: '@dcloudio/uni-h5-vue'
        }
      : undefined
  };
}

export default createViteConfig(creator());
