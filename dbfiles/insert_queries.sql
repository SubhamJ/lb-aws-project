insert into company values('c0001', 'google', '123.12.12.123', '456.45.45.456');
insert into company values('c0002', 'oracle', '234.23.23.234', '567.56.56.567');


insert into users values('12345', 'xyz', 'abc', 'admin', 'c0001');
insert into users values('23456', 'pqr', 'def', 'super-admin', 'c0002');
insert into users values('34567', 'bcd', 'fgh', 'admin', 'c0002');


insert into content values('v0001', 'toon1', 'Explains the working of water-cycle', 'c0001', 'google/v0001');
insert into content values('v0002', 'toon2', 'Explain the process of creating an animated-video', 'c0002', 'oracle/v0002');
insert into content values('v0003', 'toon3', 'a', 'c0001', 'google/v0003');
insert into content values('v0004', 'toon4', 'b', 'c0002', 'oracle/v0004');
insert into content values('v0005', 'toon5', 'c', 'c0001', 'google/v0005');
insert into content values('v0006', 'toon6', 'd', 'c0002', 'oracle/v0006');
insert into content values('v0007', 'toon7', 'e', 'c0001', 'google/v0007');
insert into content values('v0008', 'toon8', 'f', 'c0002', 'oracle/v0008');


insert into content_details values('d0001', 'v0001', 'Asset1');
insert into content_details values('d0002', 'v0001', 'Asset2');
insert into content_details values('d0003', 'v0001', 'Asset3');
insert into content_details values('d0004', 'v0001', 'Asset4');
insert into content_details values('d0005', 'v0002', 'Asset1');
insert into content_details values('d0006', 'v0002', 'Asset2');
