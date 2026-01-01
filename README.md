# AI Dev Company WordPress 主题

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)
![License](https://img.shields.io/badge/license-GPLv2-green.svg)
![Status](https://img.shields.io/badge/status-Beta-orange.svg)

**AI Dev Theme** 是一款专为 AI 开发机构、科技初创公司和前瞻性软件公司设计的先锋派 WordPress 主题，采用了独特的赛博朋克（Cyberpunk）风格。

本主题基于性能优先、SEO 友好和现代化设计原则构建，旨在弥合传统 WordPress 开发与 AI 时代之间的鸿沟。

## ✨ 核心特性

### 🎨 现代 UI/UX 设计
*   **赛博朋克美学**：默认深色模式，搭配霓虹色调、故障艺术效果（Glitch Effects）和扫描线动画。
*   **响应式设计**：基于 CSS Grid 和 Flexbox 的全流体布局。
*   **SCSS 架构**：模块化且易于维护的样式系统。

### 🧩 Elementor 深度集成
包含一套专为科技展示定制的 Elementor 小部件：
*   **AI Home Hero**：具有终端打字效果和代码执行模拟的 Hero 区域。
*   **Project Showcase**：可筛选的项目案例网格展示。
*   **Tech Stack**：技术栈和框架的网格展示。
*   **AI Split Feature**：传统开发 vs AI 开发的对比布局。
*   **Stats Counter**：动态数字统计动画。
*   **Team Grid**：带社交链接的团队成员简介。
*   **Timeline**：垂直时间轴/路线图展示。

### 🤖 AI 驱动功能
*   **AI SEO 引擎**：内置模块，可模拟 AI 智能体自动分析内容并生成 SEO 标题、描述和关键词。
*   **性能指标可视化**：用于展示 AI 提效数据的可视化图表组件。

### 🚀 技术卓越性
*   **自定义文章类型 (CPT)**：专用的 `Project`（项目）类型，包含 `Industry`（行业）和 `Technology`（技术）分类法。
*   **SEO 深度优化**：
    *   自动生成 JSON-LD 结构化数据（支持 Organization, WebSite, Article, SoftwareApplication, BreadcrumbList）。
    *   支持 OpenGraph 和 Twitter Card 社交元标签。
    *   完美兼容 Polylang 多语言插件。
*   **开发者友好**：采用单例模式（Singleton）和自动加载（Autoloading）的面向对象 PHP 架构。

## 🛠 安装指南

1.  **下载**：克隆本仓库或下载 ZIP 压缩包。
2.  **上传**：将主题文件夹上传至 `wp-content/themes/` 目录。
3.  **激活**：进入 WordPress 后台 > 外观 > 主题，激活 "AI Dev Theme"。
4.  **依赖项**：
    *   **Elementor**：页面构建必需插件。
    *   **Polylang**：多语言支持推荐插件。

## 💻 开发指南

本主题使用 `npm` 管理前端资源，使用 `sass` 进行样式编译。

### 环境要求
*   Node.js & npm
*   Composer（可选，用于未来的 PHP 依赖管理）

### 设置步骤
```bash
# 安装依赖
npm install
```

### 构建命令
```bash
# 监听文件变更 (SCSS)
npm run watch

# 生产环境构建 (压缩 CSS)
npm run build:css
```

## 📂 项目结构

```text
ai-dev-theme/
├── assets/             # 静态资源 (SCSS, JS, Images)
├── inc/                # PHP 类和辅助函数
│   ├── classes/        # 核心逻辑 (Setup, SEO, CPT, Elementor)
│   ├── widgets/        # 自定义 Elementor 小部件
│   └── traits/         # PHP Traits (Singleton)
├── languages/          # 翻译文件 (.po/.mo)
├── page-templates/     # 自定义页面模板
├── template-parts/     # 可复用的模板片段
├── front-page.php      # 自定义首页模板
├── single-project.php  # 项目详情页模板
└── style.css           # 主题声明文件
```

## 🗺 开发路线图

- [x] **M1: 基础架构**：搭建主题基础结构和资源管理。
- [x] **M2: 核心逻辑**：实现 CPT、分类法和基础模板。
- [x] **M3: UI 系统**：开发赛博朋克设计系统和 SCSS 框架。
- [x] **M4: Elementor**：开发自定义小部件套件。
- [x] **M5: 智能化**：开发 AI SEO 模块和多语言支持。
- [ ] **M6: 优化与发布**：性能调优、单元测试和 1.0 版本发布。

## 🤝 参与贡献

欢迎提交代码！请阅读 [CONTRIBUTING.md](CONTRIBUTING.md) 了解我们的行为准则以及提交 Pull Request 的流程。

## 📄 开源协议

本项目基于 GNU General Public License v2 或更高版本授权 - 详情请参阅 [LICENSE](LICENSE) 文件。
