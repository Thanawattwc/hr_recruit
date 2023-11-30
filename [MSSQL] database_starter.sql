USE [master]
GO

/****** Object:  Database [HR_JOBDEV]    Script Date: 8/16/2023 1:45:30 PM ******/
CREATE DATABASE [HR_JOBDEV]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'HR_JOBDEV', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\HR_JOBDEV.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'HR_JOBDEV_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\HR_JOBDEV_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO

IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [HR_JOBDEV].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO

ALTER DATABASE [HR_JOBDEV] SET ANSI_NULL_DEFAULT OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET ANSI_NULLS OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET ANSI_PADDING OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET ANSI_WARNINGS OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET ARITHABORT OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET AUTO_CLOSE OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET AUTO_SHRINK OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET AUTO_UPDATE_STATISTICS ON 
GO

ALTER DATABASE [HR_JOBDEV] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET CURSOR_DEFAULT  GLOBAL 
GO

ALTER DATABASE [HR_JOBDEV] SET CONCAT_NULL_YIELDS_NULL OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET NUMERIC_ROUNDABORT OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET QUOTED_IDENTIFIER OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET RECURSIVE_TRIGGERS OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET  DISABLE_BROKER 
GO

ALTER DATABASE [HR_JOBDEV] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET TRUSTWORTHY OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET PARAMETERIZATION SIMPLE 
GO

ALTER DATABASE [HR_JOBDEV] SET READ_COMMITTED_SNAPSHOT OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET HONOR_BROKER_PRIORITY OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET RECOVERY FULL 
GO

ALTER DATABASE [HR_JOBDEV] SET  MULTI_USER 
GO

ALTER DATABASE [HR_JOBDEV] SET PAGE_VERIFY CHECKSUM  
GO

ALTER DATABASE [HR_JOBDEV] SET DB_CHAINING OFF 
GO

ALTER DATABASE [HR_JOBDEV] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO

ALTER DATABASE [HR_JOBDEV] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO

ALTER DATABASE [HR_JOBDEV] SET DELAYED_DURABILITY = DISABLED 
GO

ALTER DATABASE [HR_JOBDEV] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO

ALTER DATABASE [HR_JOBDEV] SET QUERY_STORE = OFF
GO

USE [HR_JOBDEV]
GO

/****** Object:  Table [dbo].[authen]    Script Date: 8/16/2023 1:48:27 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[authen](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[position_name] [nvarchar](100) NOT NULL,
	[username] [nvarchar](50) NOT NULL,
	[fullname] [nvarchar](100) NOT NULL,
	[email] [nvarchar](100) NOT NULL,
	[Phone] [nvarchar](15) NOT NULL,
	[role] [nvarchar](10) NOT NULL,
	[active] [bit] NOT NULL,
	[create_date] [datetime] NOT NULL,
	[create_by] [nvarchar](15) NOT NULL,
	[update_date] [datetime] NOT NULL,
	[update_by] [nvarchar](15) NOT NULL
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[company]    Script Date: 8/16/2023 1:53:13 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[company](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[company_code] [nvarchar](4) NOT NULL,
	[company_name] [nvarchar](100) NOT NULL,
	[active] [bit] NOT NULL,
	[create_date] [datetime] NOT NULL,
	[create_by] [nvarchar](15) NOT NULL,
	[update_date] [datetime] NOT NULL,
	[update_by] [nvarchar](15) NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[job]    Script Date: 8/16/2023 1:53:41 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[job](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[job_number] [nvarchar](16) NOT NULL,
	[start_date] [datetime] NOT NULL,
	[end_date] [datetime] NOT NULL,
	[job_portal] [bit] NOT NULL,
	[job_referral] [bit] NOT NULL,
	[company_code] [nvarchar](4) NOT NULL,
	[plant_code] [nvarchar](4) NOT NULL,
	[org_name] [nvarchar](100) NOT NULL,
	[postion_id] [nvarchar](9) NOT NULL,
	[positon_name] [nvarchar](100) NOT NULL,
	[owner_email] [nvarchar](100) NOT NULL,
	[owner_fullname] [nvarchar](25) NOT NULL,
	[owner_postion_name] [nvarchar](100) NOT NULL,
	[owner_phone_number] [nvarchar](20) NOT NULL,
	[cost_center] [nvarchar](10) NOT NULL,
	[gl_code] [nvarchar](6) NOT NULL,
	[internal_order] [nvarchar](12) NOT NULL,
	[budget] [bit] NOT NULL,
	[position_detail] [text] NOT NULL,
	[status] [nvarchar](7) NOT NULL,
	[active] [bit] NOT NULL,
	[repost] [int] NOT NULL,
	[create_date] [datetime] NOT NULL,
	[create_by] [nvarchar](15) NOT NULL,
	[update_date] [datetime] NOT NULL,
	[update_by] [nvarchar](15) NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

/****** Object:  Table [dbo].[location]    Script Date: 8/16/2023 1:54:15 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[location](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[location_code] [nvarchar](4) NOT NULL,
	[location_name] [nvarchar](100) NOT NULL,
	[active] [bit] NOT NULL,
	[create_date] [datetime] NOT NULL,
	[create_by] [nvarchar](15) NOT NULL,
	[update_date] [datetime] NOT NULL,
	[update_by] [nvarchar](15) NOT NULL
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[log]    Script Date: 8/16/2023 1:54:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[log](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[job_number] [nvarchar](16) NOT NULL,
	[username] [nvarchar](30) NOT NULL,
	[fullname] [nvarchar](100) NOT NULL,
	[action] [nvarchar](100) NOT NULL,
	[create_date] [datetime] NOT NULL
) ON [PRIMARY]
GO



/****** Object:  Table [dbo].[mail]    Script Date: 8/16/2023 1:55:07 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[mail](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[job_number] [nvarchar](16) NOT NULL,
	[email_to] [nvarchar](50) NOT NULL,
	[email_cc] [nvarchar](50) NOT NULL,
	[email_file] [text] NOT NULL,
	[status] [nvarchar](25) NOT NULL,
	[remark] [nvarchar](255) NOT NULL,
	[create_date] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

/****** Object:  Table [dbo].[register]    Script Date: 10/6/2023 3:37:28 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[register](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[job_number] [nvarchar](16) NOT NULL,
	[emp_id] [nvarchar](10) NOT NULL,
	[fullname] [nvarchar](100) NOT NULL,
	[user_name] [nvarchar](100) NOT NULL,
	[email] [nvarchar](100) NOT NULL,
	[phone] [nvarchar](50) NULL,
	[company_code] [nvarchar](4) NOT NULL,
	[company_name] [nvarchar](100) NOT NULL,
	[plant_code] [nvarchar](4) NOT NULL,
	[plant_name] [nvarchar](100) NOT NULL,
	[org_name] [nvarchar](150) NOT NULL,
	[position_name] [nvarchar](100) NOT NULL,
	[file_path] [text] NULL,
	[portal] [bit] NULL,
	[create_date] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[runningnumber]    Script Date: 8/16/2023 1:56:10 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[runningnumber](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[company_code] [nvarchar](4) NOT NULL,
	[year] [nvarchar](2) NOT NULL,
	[month] [nvarchar](2) NOT NULL,
	[day] [nvarchar](2) NOT NULL,
	[number] [int] NOT NULL,
	[create_date] [datetime] NOT NULL
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[authen] ADD  CONSTRAINT [DF_authen_update_date]  DEFAULT (getdate()) FOR [update_date]
GO
ALTER TABLE [dbo].[company] ADD  CONSTRAINT [DF_company_update_date]  DEFAULT (getdate()) FOR [update_date]
GO
ALTER TABLE [dbo].[location] ADD  CONSTRAINT [DF_location_update_date]  DEFAULT (getdate()) FOR [update_date]
GO
ALTER TABLE [dbo].[job] ADD  CONSTRAINT [DF_job_update_date]  DEFAULT (getdate()) FOR [update_date]
GO
USE [master]
GO
ALTER DATABASE [HR_JOBDEV] SET  READ_WRITE 
GO
