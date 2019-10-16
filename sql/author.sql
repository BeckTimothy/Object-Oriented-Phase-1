drop table if exists articleTag;
drop table if exists tag;
drop table if exists article;
drop table if exists author;

create table author(
	authorId binary(16) not null,
	authorActivationToken char(32),
	authorAvatarUrl varchar(255),
	authorEmail varchar(128) not null,
	authorHash char(97) not null,
	authorUsername varchar(32) not null,
	unique(authorEmail),
	unique(authorUsername),
	primary key(authorId)
);