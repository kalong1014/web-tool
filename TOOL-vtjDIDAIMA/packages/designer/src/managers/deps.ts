import type { Dependencie, PlatformType } from '@vtj/core';
import { toArray } from '@vtj/utils';
import { builtInDeps } from './built-in';

class DepsManager {
  constructor(private deps: Dependencie[] = builtInDeps) {}

  /**
   * 匹配平台的依赖
   * @param platform
   * @returns
   */
  private matchDeps(platform?: PlatformType) {
    if (!platform) return this.deps;
    const result: Dependencie[] = [];
    for (const dep of this.deps) {
      if (!dep.platform) {
        result.push(dep);
      } else {
        const array = toArray(dep.platform);
        if (array.includes(platform)) {
          result.push(dep);
        }
      }
    }
    return result;
  }

  /**
   * 获取内置依赖
   * @returns
   */
  get() {
    return this.deps;
  }
  /**
   * 重置内置依赖
   * @param deps
   */
  set(deps: Dependencie[]) {
    this.deps = deps;
  }
  /**
   * 增加依赖项
   * @param dep
   */
  add(dep: Dependencie) {
    const match = this.deps.find((n) => n.package === dep.package);
    /**
     * 内置依赖已存在的，进行合并更新，没有即增加
     */
    if (match) {
      Object.assign(match, dep);
    } else {
      this.deps.push(dep);
    }
  }
  /**
   * 项目与内置依赖进行合并，返回合并最终结果
   * @param projectDeps
   * @returns
   */
  merge(projectDeps: Dependencie[], platform?: PlatformType) {
    const matches = this.matchDeps(platform);

    const deps: Dependencie[] = [];
    /**
     * 遍历内置依赖，找到与项目依赖相同依赖名称的项进行合并
     */
    for (const dep of matches) {
      const userDep = projectDeps.find((n) => n.package === dep.package);
      deps.push(
        userDep
          ? {
              ...userDep,
              ...dep,
              enabled: userDep.enabled
            }
          : dep
      );
    }

    /**
     * 内置依赖中没有项目依赖的项，取项目自己的项
     */
    for (const dep of projectDeps) {
      const match = matches.find((n) => n.package === dep.package);
      if (!match) {
        deps.push(dep);
      }
    }
    return deps;
  }

  /**
   * 删除内置依赖项
   * @param name
   */
  remove(name: string) {
    const index = this.deps.findIndex((n) => n.package === name);
    if (index > -1) {
      this.deps.splice(index, 1);
    }
  }
}

export const depsManager = new DepsManager();
