drop table if exists calendar;

/*==============================================================*/
/* Table: calendar                                              */
/*==============================================================*/
create table calendar
(
   Id                   int not null auto_increment comment '�ճ�����',
   Subject              varchar(2000) character set utf8 comment '�ճ̱���',
   Location             varchar(200) character set utf8 comment '�ص�',
   MasterId             int,
   Description          varchar(500) character set utf8 comment '˵��',
   CalendarType         tinyint default 1 comment '�ճ�����
            1	�����ճ�
            2	�����ճ�',
   StartTime            datetime not null comment '��ʼʱ��',
   EndTime              datetime not null comment '����ʱ��',
   IsAllDayEvent        bit not null default 0 comment '�Ƿ�ȫ���ճ�',
   HasAttachment        bit not null default 0 comment '�Ƿ��и���',
   Category             varchar(400) character set utf8 comment '����',
   InstanceType         tinyint not null comment 'ʵ������
            0	Single��һ���ճ̣�
            1	Master��ѭ�����ճ̣�
            2	Instance��ѭ��ʵ���ճ̣�
            3	Exception ������
            4	MeetingRequest�����鰲�ţ�',
   Attendees            varchar(500) character set utf8 comment '������',
   AttendeeNames        varchar(500) character set utf8 comment '����������',
   OtherAttendee        varchar(500) character set utf8 comment '����������',
   UPAccount            varchar(100) character set utf8 comment '�������˺�',
   UPName               varchar(100) character set utf8 comment '����������',
   UPTime               datetime comment '���һ�θ���ʱ��',
   RecurringRule        varchar(1000) character set utf8 comment 'ѭ������',
   primary key (Id)
);
