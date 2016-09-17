#laravel Blog
</br>
#[演示地址](http://139.199.109.117/blog/public/home)
</br>
***
第一次尝试使用了laravel，总体的感觉这是一个很庞大的框架，相比较thinkphp或是ci，laravel的冗余程度可以达到最大，
但这并不掩盖它的有
***
##Ioc
</br>
虽然现在也不能理解容器的原理到底是怎么实现的（还得深入的去看php啊），但我感觉这样的容器先进之处就在与极大的降低了对于类中方法的依赖，
相比工厂模式中可以快速大量的生产出实物，Ioc则是打破了工厂模式类型固定的特点，任意的添加原理和方法，
这也就是thinkphp5.0开始向laravel转变原因吧。
当然啦，laravel本身一提供了许多的方法，但是究其根本，都是Ioc容器衍生出来的～
添加一个关于容器的链接吧：[神奇的Ioc容器]( https://laravel-china.org/topics/789)
***
##博客配置：
</br>
###后端框架：laravel 5.2
###前端：html、js、jquery
遗憾的是虽然前后段的交互手段是ajax，但是没有实现完全的前后段分离
###用户：管理员、普通游客
###后台功能：
####(1)管理员的注册（分为手动注册和第三方Github登录）
####(2)邮箱的绑定（可通过smtp发送邮件，内含新的用户密码）
####(3)文章的生成（按照标签分类）
####(4)文章的分页（模板）
####(5)文件管理系统（laravel自带的实在是功能比较小，我参照laravel学院自己搭建了一个）
[学院地址](http://laravelacademy.org/post/2333.html)
####(5)游客评论的管理功能（删除、邮箱）
###前端功能：
####(1)文章的浏览
####(2)游客留言
####(3)简单的站内搜索（只是对于文章的标题）
####(4)ajax刷新（评论）
####(5)bootstrap搭建（cdn）
[仿照样式地址](http://www.golaravel.com/)
***
##前后端数据交互问题
</br>
####1：用户验证（最好前后端都加以验证）
####2：数据的存储（用户的密码采用的是laravel自带的Crypt,将加密后的数据存入到数据库中，防止数据窃取）
####3：表单的验证（添加了CSRF，防止跨域请求）
####4：数据传输（以多维数组为主，但为加密，存在隐患）
####5：ajax获取数据后js的处理（优化不够）
***
##无限级评论回复
</br>
###生成方式：无线递归（前，后端）
###后端代码：
``` 
<?php
//get comments
function getcomments($model,$msg_id = 0,$parent_id = 0,&$result = array()){
    $comments = DB::table($model)->where('msg_id','=',$msg_id)->where('parent_id', '=', $parent_id)->get();
	$model = $model;
	if(empty($comments)){
		return array();
	}
	foreach ($comments as $cm) {
		$thisArr = &$result[];
		$cm->children = getcomments($model,$cm->msg_id,$cm->id,$thisArr);
		$thisArr = $cm;
	}
	return $result;	
}

```
####采取了引用的方式，将文章的子回复添加到自己的children索引下（该函数通过composer.json添加）
###前端的代码：
```
$(document).ready(function(){
    			$.get("comment/upload/{{$msgindex}}",function(data){
					var len = data.length;
					for (var i = 0; i < len; i++) {
						tree = commentstree(data[i]);
						var Cms = document.getElementById('cms');
						Cms.appendChild(tree);
					};
				});
			});
```
####通过ajax中的get方法获得
####再通过递归函数将数据转化成节点，添加到DOM中
```
function commentstree(el){
    			//container
				var comments = document.createElement('div');
				comments.className = 'comments';
				//pic
				var headpic = document.createElement('img');
				headpic.className = 'headpic';
				headpic.src = 'img/user02.png';
				//nicknamebox
				var nicknamebox = document.createElement('div');
				nicknamebox.className = 'nickname';
				//comment box
				var commentbox = document.createElement('div');
				//nickname
				var nickname = document.createElement('h4');
				nickname.innerHTML = el['nickname'];
				commentbox.appendChild(nickname);
				//created time
				var time = document.createElement('i');
				time.className = 'createdtime';
				time.innerHTML = el['created_at'];
				commentbox.appendChild(time);
				//comments
				var com = document.createElement('div');
				com.className = 'comm';
				com.innerHTML = el['comment'];
				commentbox.appendChild(com);
				//add reply
				var addcom = document.createElement('img');
				var reply = document.createElement('a');
				addcom.className = 'add-com';
				addcom.src = 'img/com.png';
				reply.innerText = '回复';
				reply.className = 'add-reply';
				reply.name = el['id'];
				commentbox.appendChild(reply);
				commentbox.appendChild(addcom);
				nicknamebox.appendChild(commentbox);
				//form
				var form = document.querySelector('.form-box').cloneNode(true);
				var parent_id = el['id'];
				form.children['0'].id = el['id'];
				form.children['0'].style.display = 'none';
				form.children['0'].children['1'] = parent_id;
				form.children['0'].children['1'].value = parent_id;
				nicknamebox.appendChild(form);
				//append
				comments.appendChild(headpic);
				comments.appendChild(nicknamebox);
				//child
				var child = [];
				if(el['children'].length != 0){
					for(var i = 0;i < el['children'].length;i ++){
						childcms = commentstree(el['children'][i]);
						comments.appendChild(childcms);
					}
				}else{
					return comments;	
				}
				return comments;	
			}
```
##这时候就会出现问题：js无法获取这新新添加的dom节点
###解决方案：js 事件委托
####具体的原理就不详细说了（js对于事件冒泡和捕获以及监听的机制），看代码吧
```
            //reply display
    		$('.panel-body').delegate("a","click",function(){
				formid = this.parentNode.children['3'].name;
				var form = document.getElementById(formid);
				if(form.style.display == 'block'){
					form.style.display = 'none';
				}else{
					form.style.display = 'block';
				}
			});
```
####至此，无限级的评论回复功能基本上就实现了
***
##社会化登录
</br>
###这个其实挺简单的，通过OAuth就能调用接口，在通过回调函数获取用户的邮箱，id，nickname等
[地址](https://oauth.net/2/)
***
##Markdown 语法
</br>
###感谢开源：
[laravel-php-markdown](https://github.com/yccphp/laravel-5-markdown-editor)
</br>就是时间比较老了，有段时间没有维护了
























