import { showConfirmDialog } from 'vant';

let lastSrcs: string[];

const scriptReg = /\<script.*src=["'](?<src>[^"']+)/gm;

let duration = 10000;

async function extractNewScripts() {
  const html = await fetch('?t=' + Date.now()).then((resp) => resp.text());
  scriptReg.lastIndex = 0;
  let result = [];
  let match;
  while ((match = scriptReg.exec(html))) {
    if (match.groups?.src) {
      result.push(match.groups.src);
    }
  }
  return result;
}

async function needUpdate() {
  const newScripts = await extractNewScripts();
  if (!lastSrcs) {
    lastSrcs = newScripts;
    return false;
  }
  let result = false;
  if (lastSrcs.length !== newScripts.length) {
    result = true;
  }
  for (let i = 0; i < lastSrcs.length; i++) {
    if (lastSrcs[i] !== newScripts[i]) {
      result = true;
      break;
    }
  }
  lastSrcs = newScripts;
  return result;
}

async function refresh() {
  const ret = await showConfirmDialog({
    title: '系统更新',
    message:
      '系统发现新版本，请确认是否需要更新。如果确定，系统将会重新登录，请注意存档。'
  })
    .then(() => true)
    .catch(() => false);

  if (ret) {
    const win = top || window;
    win.location.reload();
  }
}

function autoRefresh() {
  setTimeout(async () => {
    const willUpdate = await needUpdate();
    if (willUpdate) {
      await refresh();
    }
    autoRefresh();
  }, duration);
}

export function autoUpdate() {
  autoRefresh();
}
