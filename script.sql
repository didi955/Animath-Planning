drop table if exists "Role" cascade;
drop table if exists "User" cascade;
drop table if exists "PersonalData" cascade;
drop table if exists "Appointement" cascade;
drop table if exists "Activities" cascade ;
drop table if exists "Stand" cascade ;
drop table if exists "LogPersonalData" cascade;
drop table if exists "LogUser" cascade;
drop table if exists "LogStand" cascade ;
drop table if exists "LogActivities" cascade ;


CREATE TABLE "Role"(
                       "id" INTEGER NOT NULL,
                       "name" VARCHAR(50) NOT NULL
);

ALTER TABLE
    "Role" ADD PRIMARY KEY("id");
ALTER TABLE
    "Role" ADD CONSTRAINT "role_name_unique" UNIQUE("name");

CREATE TABLE "User"(
                       "id_user" INTEGER NOT NULL,
                       "role" INTEGER NOT NULL,
                       "active" BOOLEAN NOT NULL,
                       "connexion_id" VARCHAR(320) NOT NULL UNIQUE,
                       "pass_hash" VARCHAR(255) NOT NULL,
                       "created_at" timestamp NOT NULL default current_timestamp
);

ALTER TABLE
    "User" ADD PRIMARY KEY("id_user");

CREATE TABLE "PersonalData"(
                               "id_user" integer NOT NULL,
                               "last_name" VARCHAR(50) NULL,
                               "first_name" VARCHAR(50) NULL,
                               "email" VARCHAR(320) NULL,
                               "phone" VARCHAR(50) NULL,
                               "school" VARCHAR(50) NULL
);
ALTER TABLE
    "PersonalData" ADD PRIMARY KEY("id_user");

CREATE TABLE "Appointement"(
                               "id_user" INTEGER NOT NULL,
                               "id_activity" INT NOT NULL,
                               "nb_student" INT NOT NULL,
                               "student_level" VARCHAR(50),
                               primary key ("id_user","id_activity")
);

CREATE TABLE "Stand"(
                        "id" INTEGER NOT NULL,
                        "title" VARCHAR(50) NOT NULL,
                        "desc" VARCHAR NOT NULL
);

ALTER TABLE
    "Stand" ADD PRIMARY KEY("id");

CREATE TABLE "Activities"(
                             "id" SERIAL NOT NULL,
                             "stand" INTEGER NOT NULL,
                             "start" VARCHAR NOT NULL,
                             "end" VARCHAR NOT NULL,
                             "student_level" VARCHAR(40) NOT NULL,
                             "capacity" INT NOT NULL,
                             primary key ("id")
);

CREATE TABLE "LogUser"(
                          "action" TEXT NOT NULL,
                          "old" "User" NULL,
                          "new" "User" NULL,
                          timestamp timestamp default current_timestamp
);
ALTER TABLE
    "LogUser" ADD PRIMARY KEY(timestamp);

CREATE TABLE "LogStand"(
                           "action" TEXT NOT NULL,
                           "old" "Stand" NULL,
                           "new" "Stand" NULL,
                           timestamp timestamp default current_timestamp
);
ALTER TABLE
    "LogStand" ADD PRIMARY KEY(timestamp);

CREATE TABLE "LogPersonalData"(
                                  "action" TEXT NOT NULL,
                                  "old" "PersonalData" NULL,
                                  "new" "PersonalData" NULL,
                                  timestamp timestamp default current_timestamp
);
ALTER TABLE
    "LogPersonalData" ADD PRIMARY KEY(timestamp);

CREATE TABLE "LogActivities"(
                                "action" TEXT NOT NULL,
                                "old" "Activities" NULL,
                                "new" "Activities" NULL,
                                timestamp timestamp default current_timestamp
);
ALTER TABLE
    "LogActivities" ADD PRIMARY KEY(timestamp);

ALTER TABLE
    "User" ADD CONSTRAINT "user_role_foreign" FOREIGN KEY("role") REFERENCES "Role"("id");

create or replace function tgLogUser() returns trigger as
$$
BEGIN
    insert into "LogUser"(action, old, new) VALUES (tg_op::text, old, new);
    return null;
end
$$ language plpgsql;

create trigger tgUser
    after insert or delete or update on "User"
    for each row
execute procedure tgLogUser();

create or replace function tgLogStand() returns trigger as
$$
BEGIN
    insert into "LogStand"(action, old, new) VALUES (tg_op::text, old, new);
    return null;
end
$$ language plpgsql;

create trigger tgStand
    after insert or delete or update on "Stand"
    for each row
execute procedure tgLogStand();

create or replace function tgLogPersonalData() returns trigger as
$$
BEGIN
    insert into "LogPersonalData"(action, old, new) VALUES (tg_op::text, old, new);
    return null;
end
$$ language plpgsql;

create trigger tgPersonalData
    after insert or delete or update on "PersonalData"
    for each row
execute procedure tgLogPersonalData();

create or replace function tgLogActivities() returns trigger as
$$
BEGIN
    insert into "LogActivities"(action, old, new) VALUES (tg_op::text, old, new);
    return null;
end
$$ language plpgsql;

create trigger tgActivities
    after insert or delete or update on "Activities"
    for each row
execute procedure tgLogActivities();

create or replace function verifPersonalData() returns trigger as
$$
BEGIN
    if (SELECT role from "User" where id_user = new.id_user) <> 2 then
        return old;
    end if;
    return new;
end
$$ language plpgsql;

create or replace function verifAppointement() returns trigger as
$$
BEGIN
    if (SELECT role from "User" where id_user = new.id_user) <> 2 then
        return old;
    end if;
    return new;
end
$$ language plpgsql;

create trigger verifPersonalData
    before insert on "PersonalData"
    for each row
execute procedure verifPersonalData();

create trigger verifAppointement
    before insert on "Appointement"
    for each row
execute procedure verifAppointement();

create or replace function standCascade() returns trigger as
$$
BEGIN
    DELETE FROM "Activities" WHERE stand=old.id;
    return null;
end
$$ language plpgsql;

create or replace function activitiesCascade() returns trigger as
$$
BEGIN
    DELETE FROM "Appointement" WHERE id_activity=old.id;
    return null;
end
$$ language plpgsql;

create trigger standCascade
    after delete on "Stand"
    for each row
execute procedure standCascade();

create trigger activitiesCascade
    after delete on "Activities"
    for each row
execute procedure activitiesCascade();

INSERT INTO "Role" (id,name) VALUES (1,'Supervisor');
INSERT INTO "Role" (id,name) VALUES (2,'Professor');

INSERT INTO "User" (id_user, role, active, connexion_id, pass_hash) VALUES (1, 1, true, 'admin@animath.fr', '$argon2id$v=19$m=65536,t=4,p=1$bUlZcThpVEM4TTAzRzNMRA$43ZIZn1EVaAFW+wvyxaKtQ');
