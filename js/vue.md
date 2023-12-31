# Vue

## import

## テンプレート構文`<template>...</template>`

# #テキスト展開のマスタッシュ構文(二重中括弧)

## リアクティビティー

### `ref()`

テンプレート内で `ref` を使用し、後から `ref` の値を変更した場合、Vue は自動的にその変更を検出し、それに応じて DOM を更新します。これは、依存関係追跡ベースのリアクティビティーシステムによって実現されています。コンポーネントが初めてレンダリングされるとき、Vue はレンダリング中に使用されたすべての `ref` を追跡します。その後 `ref` が変更されると、それを追跡しているコンポーネントの再レンダリングがトリガーされます。

### `reactive()`

リアクティブな状態を宣言する方法として、`reactive()` という API を使う方法もあります。内側の値を特別なオブジェクトでラップする ref とは異なり、`reactive()` はオブジェクト自体をリアクティブにします.

オブジェクト型 (オブジェクト、配列、および Map や Set などの コレクション型) に対してのみ機能します。文字列、数値、真偽値などの プリミティブ型 を保持できません。

### 算出プロパティー `computed()`

## Vueディレクティブ
- `v-bind:name`, `:name`
- `v-on:event`, `@event`
- `v-if`, `v-else-if`, `v-else`
- `v-for`
- `v-text`,`v-html`, `v-pre` ,`v-slot`
- `v-show`, `v-once`
- `v-model`

## Component
- 単一ファイルコンポーネント（SFC）